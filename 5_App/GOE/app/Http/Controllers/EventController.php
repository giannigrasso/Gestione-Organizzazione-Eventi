<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\Hotel;
use App\Models\Link as ModelsLink;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Exception;
use App\Models\Room;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = auth()->user();
        if(Hash::check('user', $user->password)) {
            $data = [
                "user" => $user
            ];
            return view("users.show", $data);
        }else {
            if($user->name_type == 'admin') {
                $data = Event::all();
                return view("events.index", ["events"=>$data]);
            }else {
    
                $data = Event::select('events.*')
                ->leftJoin('links', 'events.id', '=', 'links.id_event')
                ->where('id_user', $user->id)->get();
    
                return view("events.index", ["events"=>$data]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = auth()->user();
        $hotels = Hotel::select('hotels.*')
                ->leftJoin('events', 'hotels.id', '=', 'events.id_hotel')
                ->distinct()->get();

        if($user->name_type == 'admin') {
            $data = [
                "hotels" => $hotels
            ];
            return view("events.create", $data);
        }else {
            return redirect('/events');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'evento' => 'required',
            'partecipanti' => 'required|min:1',
            'data' => 'required',
            'hotel' => 'required',
        ]);
        $hotel = Hotel::select('hotels.*')
        ->where('hotels.name', $request->input('hotel'))->get()->first();

        $event = new Event();
        $event->name = $request->input('evento');
        $event->capacity = $request->input('partecipanti');
        $event->date = $request->input('data');

        $event->id_hotel = $hotel->id;
        $event->save();


        $this->uploadCsv($request);
        return redirect('/events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event) {
        $user = auth()->user();
        $users = User::select('users.*')
        ->leftJoin('links', 'users.id', '=', 'links.id_user')
        ->where('links.id_event', $event->id)->get();
        
        $hotel = Hotel::select('hotels.*')
        ->leftJoin('events', 'hotels.id', '=', 'events.id_hotel')
        ->where('hotels.id', $event->id_hotel)->get()->first();

        $rooms = Room::select('rooms.*')
        ->leftJoin('events', 'rooms.id_hotel', '=', 'events.id_hotel')
        ->where('events.id', $event->id)->get();
        

        /**
         * SELECT DISTINCT id, name, gender, id_event, id_group
         *   FROM groups
         *  INNER JOIN links ON groups.id=links.id_group
         *  WHERE links.id_event = 1;
         */
        $groups = Group::select('groups.id', 'groups.name', 'groups.gender')
        ->leftJoin('links', 'groups.id', '=', 'links.id_group')
        ->where('links.id_event', $event->id)->distinct()->get();

        /**
         * SELECT DISTINCT id, name, id_group1, id_group2, id_event
         * FROM companies WHERE id_event = 2;
         */
        $companies = Company::select('companies.*')
        ->where('companies.id_event', $event->id)->get();

        if($user->name_type == 'admin') {
            $data = [
                "event" => $event,
                "users" => $users,
                "groups" => $groups,
                "companies" => $companies,
                "hotel" => $hotel,
                "rooms" => $rooms
            ];

            return view('events.show', $data);
        }else {
            $links = ModelsLink::where([
                ['id_user', '=', $user->id],
                ['id_event', '=', $event->id],
            ])->first();
            /*select *
            FROM groups
            WHERE id IN
                (SELECT id_group
                FROM links
                WHERE id_group = 3);*/
            //PROBLEMI CON IL FIRST

            if(!empty($links)) {
                $data = [
                    "event" => $event,
                    "users" => $users,
                    "groups" => $groups,
                    "companies" => $companies,
                    "hotel" => $hotel,
                    "rooms" => $rooms
                ];
                return view('events.show', $data);
            }else{
                return redirect('/events');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event) {
        $user = auth()->user();
        $selectedHotel = Hotel::select('hotels.*')
                ->leftJoin('events', 'hotels.id', '=', 'events.id_hotel')
                ->where('events.id', $event->id)->get()->first();
        $hotels = Hotel::select('hotels.*')
                ->leftJoin('events', 'hotels.id', '=', 'events.id_hotel')
                ->whereNot('hotels.id', $event->id_hotel)->distinct()->get();

        if($user->name_type == 'admin') {
            $data = [
                "event" => $event,
                "selectedHotel" => $selectedHotel,
                "hotels" => $hotels
            ];
            return view('events.edit', $data);
        }else {
            redirect('/events');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event) {
        $request->validate([
            'name' => 'required|max:100',
            'date' => 'required|max:100',
            'hotel' => 'required',
        ]);

        $hotel = Hotel::select('hotels.*')
        ->where('hotels.name', $request->input('hotel'))->get()->first();
                
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        try {
            $event->id_hotel = $hotel->id;
          }catch(\Exception $e) {
            return redirect()->route('hotels.index');
          }


        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event) {
        $user = auth()->user();
        
        if($user->name_type == 'admin') {
            DB::table('links')->where('id_event', $event->id)->delete();
            $event->delete();

            return redirect('/events');
        }
    }

    public function uploadCsv(Request $request) {
        //Excel::import(new UsersImport, $request->formFile);
        //ESTENSIONE php_fileinfo
        //ANCORA DA TESTARE
        $maxId = DB::table('events')->max('id');
        $event = Event::select('events.*')
                ->where('id', $maxId)->get()->first();
        

        /*
        $group = new Group();
        $group->name = "Generic" . $group->id;
        $group->gender = 1;
        $group->save();*/

            $filename = $_FILES["formFile"]["tmp_name"];
            if($filename == ""){
                return redirect('/events');
            }
            $file = fopen($filename, "r");

            while(($column = fgetcsv($file, 10000, ";")) !== FALSE) {
                $user = new User();
                $user->email = $column[0];
                $user->first_name = $column[1];
                $user->last_name = $column[2];
                $user->birth_date = $column[3];
                $user->gender = $column[4];
                $user->name_type = $column[5];
                $user->password = bcrypt("user");
                $user->save();

                $link = new ModelsLink();
                $link->id_event = $event->id;
                $link->id_group = 7;
                $link->id_user = $user->id;

                $link->save();
            }
            return redirect('/events');
    }
}