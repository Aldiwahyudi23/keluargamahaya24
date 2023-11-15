<?php

namespace App\Http\Controllers;

use App\Models\LayoutAppUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LayoutAppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_layout = LayoutAppUser::all();

        return view('backend.layouts_user.index', compact('data_layout'));
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

        $data = new LayoutAppUser();
        $data->user_id = $request->user_id;
        $data->navbar = $request->navbar;
        $data->menu = $request->menu;
        $data->sider = $request->sider;

        $data->save();

        return redirect()->back()->with('sukses', 'Oke account aman');
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

        $data = LayoutAppUser::find($id);
        $data->user_id = $request->user_id;
        $data->navbar = $request->navbar;
        $data->menu = $request->menu;
        $data->sider = $request->sider;

        $data->save();

        return redirect()->back()->with('sukses', 'Oke account aman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
