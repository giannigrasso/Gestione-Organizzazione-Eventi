<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Link as ModelsLink;
use App\Models\Event;
use App\Models\Userroom;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event) {
        $user = auth()->user();


        $users = User::select('users.*')
        ->leftJoin('links', 'users.id', '=', 'links.id_user')
        ->where('links.id_event', $event->id)->distinct()->get();
        
        if($user->name_type == 'consigliere') {
            $data = [
                "users" => $users,
            ];
            return view("groups.create", $data);
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
    public function store(Request $request, Event $event) {
        $request->validate([
            'gruppo' => 'required',
        ]);

        $group = new Group();
        $group->name = $request->input('gruppo');
        $group->gender = 1;
        $group->save();

        $usedGroup = Group::select('groups.*')
        ->where('groups.id', $group->id)->get()->first();

        for ($i=0; $i < 400; $i++) {
            if($request->input($i) == "on") {
                $usedUser = User::select('users.*')
                ->where('users.id', $group->id)->get()->first();

                $link = new ModelsLink();
                $link->id_event = $request->input('gruppo');
                $link->id_group = $usedGroup->id;
                $link->id_user = $request->input('gruppo');
            } 
        }
        
        dd();
        
        
        return redirect('/events');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group) {
        $user = auth()->user();
        $users = User::select('users.*')
        ->leftJoin('links', 'users.id', '=', 'links.id_user')
        ->where('links.id_group', $group->id)->get();

        if($user->name_type == 'admin') {
            $data = [
                "group" => $group,
                "users" => $users
            ];
            return view('groups.show', $data);
        }else {
            $links = ModelsLink::where([
                ['id_user', '=', $user->id],
                ['id_group', '=', $group->id],
            ])->first();

            if(!empty($links)) {
                $data = [
                    "group" => $group,
                    "users" => $users
                ];
                return view('groups.show', $data);
            }else{
                return redirect('/events');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
