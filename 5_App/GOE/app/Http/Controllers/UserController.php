<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        $data = [
            "user" => $user
        ];
        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100'
        ]);
                
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        
        if(Hash::check($request->input('old'), $user->password)) {
            if($request->input('new') == $request->input('confirm')) {
                $user->password = bcrypt($request->input('new'));
                echo '<div class="container">
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Password cambiata con successo
                    </div>
                    </div>';
            }else {
                echo '<div class="container">
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Le password non corrispondono
                    </div>
                    </div>';
            }
        }else{
            echo '<div class="container">
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Le password non corrispondono
                    </div>
                    </div>';
        }

        $user->save();
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
