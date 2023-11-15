<?php

namespace App\Http\Controllers;

use App\Models\access_menu;
use App\Http\Controllers\Controller;
use App\Models\AccessMenu;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AccessMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_menu = Menu::all();
        $data_role = Role::all();
        $data_access_menu = AccessMenu::all();

        return view('backend.setting.access_menu.index', compact('data_menu', 'data_role', 'data_access_menu'));
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

        $data = new AccessMenu();
        $data->menu_id = $request->menu_id;
        $data->role_id = $request->role_id;

        $cek_access = AccessMenu::where('menu_id', $request->menu_id)->where('role_id', $request->role_id);
        if ($cek_access->count() < 1) {
            $data->save();
            return redirect()->back()->with('sukses', 'Atos ka tambahkeun Akses');
        } else {
            $cek_access->forceDelete();
            return redirect()->back()->with('kuning', 'Ngahapus akses');
        }
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
        $id = Crypt::decrypt($id);
        $data_role = Role::find($id);
        $data_menu = Menu::all();
        $data_access_menu = AccessMenu::all();


        return view('backend.setting.access_menu.access', compact('data_role', 'data_access_menu', 'data_menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
