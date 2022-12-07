<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Link as ModelsLink;
use App\Models\Event;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = auth()->user();

        if($user->name_type == 'admin') {
            $data = Hotel::all();
            return view("hotels.index", ["hotels"=>$data]);
        }else {
            return redirect('/events');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = auth()->user();
        if($user->name_type == 'admin') {
            return view("hotels.create");
        }else {
            return redirect('/hotels');
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
            'nome' => 'required',
            'nazione' => 'required',
            'citta' => 'required',
            'indirizzo' => 'required'
        ]);

        $hotel = new Hotel();
        $hotel->name = $request->input('nome');
        $hotel->country = $request->input('nazione');
        $hotel->city = $request->input('citta');
        $hotel->address = $request->input('indirizzo');
        $hotel->save();
        return redirect('/hotels');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel) {
        $user = auth()->user();
        $rooms = Room::select('rooms.*')
        ->where('rooms.id_hotel', $hotel->id)->get();


        if($user->name_type == 'admin') {
            $data = [
                "hotel" => $hotel,
                "rooms" => $rooms
            ];
            return view('hotels.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel) {
        $user = auth()->user();
        if($user->name_type == 'admin') {
            $data = [
                "hotel" => $hotel
            ];
            return view('hotels.edit', $data);
        }else {
            return redirect('/hotels');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel) {
        $request->validate([
            'name' => 'required|max:100',
            'country' => 'required|max:100',
            'city' => 'required|max:100',
            'address' => 'required|max:100'
        ]);
                
        $hotel->name = $request->input('name');
        $hotel->city = $request->input('city');
        $hotel->country = $request->input('country');
        $hotel->address = $request->input('address');

        $hotel->save();
        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel) {
        $user = auth()->user();

        $events = Event::select('events.*')
        ->where('events.id_hotel', $hotel->id)->get()->first();

        $rooms = Room::select('rooms.*')
        ->where('rooms.id_hotel', $hotel->id)->get();


        if(empty($rooms)) {
            try {
                if($user->name_type == 'admin') {
                    $hotel->delete();
                    return redirect()->route('hotels.index');
                }
            } catch(Exception $e) {
                return redirect()->route('hotels.index');
            }
        } else {
            if($user->name_type == 'admin') {
                try{
                    if(empty($events)) {
                        foreach($rooms as $room) {
                            $room->delete();
                        }
                                            
                        $hotel->delete();
                    }
                    return redirect()->route('hotels.index');
                }catch(Exception $e) {
                    return redirect()->route('hotels.index');
                }
            }
        }
    }
}
