<?php

namespace App\Http\Controllers;

use App\Models\AccessSubMenu;
use App\Http\Controllers\Controller;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AccessSubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_user = User::all();
        $data_access_menu = AccessSubMenu::all();

        return view('backend.setting.access_sub_menu.index', compact('data_user', 'data_access_menu'));
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

        $data = new AccessSubMenu();
        $data->sub_menu_id = $request->sub_menu_id;
        $data->menu_id = $request->menu_id;
        $data->user_id = $request->user_id;

        $cek_data_sub_menu = SubMenu::find($request->sub_menu_id);
        $cek_access = AccessSubMenu::where('sub_menu_id', $request->sub_menu_id)->where('user_id', $request->user_id)->where('menu_id', $request->menu_id);
        if ($cek_data_sub_menu->is_active == 1) {
            if ($cek_access->count() < 1) {
                $data->save();
                return redirect()->back()->with('sukses', 'Atos ka tambahkeun Akses');
            } else {
                $cek_access->forceDelete();
                return redirect()->back()->with('infoes', 'Ngahapus akses');
            }
        } else {
            return redirect()->back()->with('kuning', 'Sub Menu Teu Aktif teu tiasa di lanjut ');
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
        $data_user = User::find($id);
        $data_sub_menu = SubMenu::all();
        $data_access_menu = AccessSubMenu::all();


        return view('backend.setting.access_sub_menu.access', compact('data_user', 'data_access_menu', 'data_sub_menu'));
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
