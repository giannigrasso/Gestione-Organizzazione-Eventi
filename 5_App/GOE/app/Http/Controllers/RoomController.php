<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;

class RoomController extends Controller
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
    public function create() {
        $user = auth()->user();
        $hotels = Hotel::select('hotels.*')
        ->leftJoin('events', 'hotels.id', '=', 'events.id_hotel')
        ->distinct()->get();
        $data = [
            "hotels" => $hotels
        ];
        if($user->name_type == 'admin') {
            return view("rooms.create", $data);
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
        $wifi = false;
        $smokingArea = false;
        $animals = false;
        
        $request->validate([
            'hotel' => 'required',
            'number' => 'required',
            'capacity' => 'required',
        ]);
        if($request->input('wifi') == "wifi") {
            $wifi = true;
        }
        if($request->input('smokingArea') == "smokingArea") {
            $smokingArea = true;
        }
        if($request->input('animals') == "animals") {
            $animals = true;
        }

        $room = new Room();
        $room->number = $request->input('number');
        $room->capacity = $request->input('capacity');
        $room->wifi = $wifi;
        $room->smoking_area = $smokingArea;
        $room->animals = $animals;

        $hotel = Hotel::select('hotels.*')
        ->where('hotels.name', $request->input('hotel'))->get()->first();
        try {
            $room->id_hotel = $hotel->id;
            $room->save();
            return redirect('/hotels');
        } catch(Exception $e) {
            return redirect()->route('hotels.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room) {
        $user = auth()->user();
        try {
            if($user->name_type == 'admin') {
                $room->delete();
                return redirect()->route('hotels.index');
            }
          } catch(Exception $e) {
                return redirect()->route('hotels.index');
          }
    }
}
