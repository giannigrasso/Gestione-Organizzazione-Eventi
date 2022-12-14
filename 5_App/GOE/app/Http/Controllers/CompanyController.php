<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Link as ModelsLink;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company) {
        $user = auth()->user();
        $users = User::select('users.*')
        ->leftJoin('links', 'users.id', '=', 'links.id_user')
        ->where('links.id_group', $company->id)->get();

        if($user->name_type == 'admin') {
            $data = [
                "company" => $company,
                "users" => $users
            ];
            return view('company.show', $data);
        }else {

            $links = Company::select('companies.*')
            ->leftJoin('links', 'companies.id_event', '=', 'links.id_event')
            ->where([
                ['links.id_event', '=', $company->id_event],
                ['links.id_user', '=', $user->id],
            ])->first();
            
            if(!empty($links)) {
                $data = [
                    "company" => $company,
                    "users" => $users
                ];
                return view('companies.show', $data);
            }else{
                return redirect('/events');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
