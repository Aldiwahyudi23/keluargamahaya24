<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Http\Controllers\Controller;
use App\Models\AllRouteUrl;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Contracts\Service\Attribute\Required;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_submenu = SubMenu::all();
        $data_menu = Menu::all();
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_sub_menu.index', compact('data_submenu', 'data_menu', 'data_route_url'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'Required|unique:sub_menus',
                'menu_id' => 'required',
                'route_url_id' => 'required',
                'icon' => 'required',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama submenu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'icon.required' => "icon submenu kedah di isi",
                'menu_id.required' => "Menu kedah di isi",
                'nama.unique' => "Nama submenu Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = new SubMenu();
        $data->nama = $request->nama;
        $data->menu_id = $request->menu_id;
        $data->route_url_id = $request->route_url_id;
        $data->icon = $request->icon;
        $data->is_active = 1;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data submenu atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $submenu = SubMenu::find($id);

        return view('backend.master_data.data_sub_menu.show', compact('submenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $submenu = SubMenu::find($id);
        $data_submenu = SubMenu::all();
        $data_menu = Menu::all();
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_sub_menu.edit', compact('data_submenu', 'submenu', 'data_menu', 'data_route_url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama' => 'required',
                'menu_id' => 'required',
                'route_url_id' => 'required',
                'icon' => 'required',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama submenu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'icon.required' => "icon submenu kedah di isi",
                'menu_id.required' => "Menu kedah di isi",
                'nama.unique' => "Nama submenu Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = SubMenu::find($id);
        $data->nama = $request->nama;
        $data->menu_id = $request->menu_id;
        $data->route_url_id = $request->route_url_id;
        $data->icon = $request->icon;
        $data->is_active = $request->is_active;
        $data->deskripsi = $request->deskripsi;

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data submenu atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = SubMenu::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data submenu atos di hapus |:');
    }

    public function trash()
    {
        $data_submenu = SubMenu::onlyTrashed()->get();
        return view('backend.master_data.data_sub_menu.trash', compact('data_submenu'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_submenu = SubMenu::withTrashed()->findOrFail($id);
        $data_submenu->restore();
        return redirect()->back()->with('infoes', ' Data submenu atos di balikeun deui');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_submenu = SubMenu::withTrashed()->findOrFail($id);
        $data_submenu->forceDelete();
        return redirect()->back()->with('kuning', 'Data submenu atos di hapus ');
    }
}
