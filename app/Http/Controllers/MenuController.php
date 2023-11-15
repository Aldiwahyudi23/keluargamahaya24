<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Models\AllRouteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_menu = Menu::all();
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_menu.index', compact('data_menu', 'data_route_url'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'Required|unique:menus',
                'route_url_id' => 'required',
                'icon' => 'required',
                'deskripsi' => 'Required',
                'kategori' => 'Required',
            ],
            [
                'nama.required' => "Nama menu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'icon.required' => "icon menu kedah di isi",
                'nama.unique' => "Nama menu Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
                'kategori.required' => "kategori kedah di isi",
            ]
        );

        $data = new Menu();
        $data->nama = $request->nama;
        $data->route_url_id = $request->route_url_id;
        $data->icon = $request->icon;
        $data->deskripsi = $request->deskripsi;
        $data->kategori = $request->kategori;
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data menu atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $menu = Menu::find($id);

        return view('backend.master_data.data_menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $menu = Menu::find($id);
        $data_menu = Menu::all();
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_menu.edit', compact('data_menu', 'menu', 'data_route_url'));
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
                'route_url_id' => 'required',
                'icon' => 'required',
                'deskripsi' => 'Required',
                'kategori' => 'Required',
            ],
            [
                'nama.required' => "Nama menu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'icon.required' => "icon menu kedah di isi",
                'nama.unique' => "Nama menu Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
                'kategori.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = Menu::find($id);
        $data->nama = $request->nama;
        $data->route_url_id = $request->route_url_id;
        $data->icon = $request->icon;
        $data->deskripsi = $request->deskripsi;
        $data->class = $request->class;
        $data->kategori = $request->kategori;

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data menu atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = Menu::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data menu atos di hapus |:');
    }

    public function trash()
    {
        $data_menu = Menu::onlyTrashed()->get();
        return view('backend.master_data.data_menu.trash', compact('data_menu'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_menu = Menu::withTrashed()->findOrFail($id);
        $data_menu->restore();
        return redirect()->back()->with('infoes', ' Data menu atos di balikeun deui');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_menu = Menu::withTrashed()->findOrFail($id);
        $data_menu->forceDelete();
        return redirect()->back()->with('kuning', 'Data menu atos di hapus ');
    }
}
