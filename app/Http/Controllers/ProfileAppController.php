<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfileApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_profileApp = ProfileApp::first();

        return view('backend.setting.profile_app.index', compact('data_profileApp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        if ($request->foto_login) {
            $file = $request->file('foto_login');
            $nama_foto = 'profile_App-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $nama_foto);
        }
        if ($request->logo_login) {
            $file = $request->file('logo_login');
            $nama_logo = 'profile_App-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $nama_logo);
        }
        if ($request->background_login) {
            $file = $request->file('background_login');
            $nama_background = 'profile_App-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $nama_background);
        }
        if ($request->foto) {
            $file = $request->file('foto');
            $foto = 'profile_App-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $foto);
        }
        if ($request->logo) {
            $file = $request->file('logo');
            $logo = 'profile_App-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $logo);
        }

        $data = ProfileApp::find($id);
        // Login
        if ($request->footer_login) {
            $data->footer_login = $request->footer_login;
        }
        if ($request->title_login) {
            $data->title_login = $request->title_login;
        }
        if ($request->info_login) {
            $data->info_login = $request->info_login;
        }
        if ($request->lupa_password == 0) {
            $data->lupa_password = 1;
        } else {
            $data->lupa_password = 2;
        }
        if ($request->foto_login) {
            $data->foto_login          = "/img/profile_app/$nama_foto";
        }
        if ($request->logo_login) {
            $data->logo_login          = "/img/profile_app/$nama_logo";
        }
        if ($request->background_login) {
            $data->background_login         = "/img/profile_app/$nama_background";
        }
        // ==========================
        // app home
        if ($request->foto) {
            $data->foto         = "/img/profile_app/$foto";
        }
        if ($request->logo) {
            $data->logo         = "/img/profile_app/$logo";
        }
        if ($request->nama) {
            $data->nama         = $request->nama;
        }

        $data->update();
        return redirect()->back()->with('sukses', 'Mantap');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function login()
    {
        $data_profileApp = ProfileApp::first();

        return view('backend.setting.profile_app.layout_login.login', compact('data_profileApp'));
    }
}
