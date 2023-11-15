<?php

namespace App\Http\Controllers;

use App\Models\MenuFooter;
use App\Http\Controllers\Controller;
use App\Models\AllRouteUrl;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MenuFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_menu_footer = MenuFooter::all();
        $data_route_url = AllRouteUrl::all();
        $data_program = Program::all();

        return view('backend.setting.profile_app.data_menu_footer.index', compact('data_program', 'data_menu_footer', 'data_route_url'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'Required|unique:sub_menus',
                'route_url_id' => 'required',
                'kategori' => 'required',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama submenu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'kategori.required' => "kategori submenu kedah di isi",
                'nama.unique' => "Nama submenu Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'menu_footer-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/menu_footer'), $nama);
        }

        $data = new MenuFooter();
        $data->nama = $request->nama;
        $data->program_id = $request->program_id;
        $data->route_url_id = $request->route_url_id;
        $data->kategori = $request->kategori;
        $data->is_active = 1;
        $data->deskripsi = $request->deskripsi;
        if ($request->icon) {
            $data->icon = $request->icon;
        }
        if ($request->foto) {
            $data->foto = "/img/menu_footer/$nama";
        }
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data submenu atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $menu_footer = MenuFooter::find($id);
        $data_menu_footer = MenuFooter::all();
        $data_route_url = AllRouteUrl::all();
        $data_program = Program::all();


        return view('backend.setting.profile_app.data_menu_footer.show', compact('data_menu_footer', 'menu_footer', 'data_route_url', 'data_program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $menu_footer = MenuFooter::find($id);
        $data_menu_footer = MenuFooter::all();
        $data_route_url = AllRouteUrl::all();
        $data_program = Program::all();

        return view('backend.setting.profile_app.data_menu_footer.edit', compact('data_menu_footer', 'menu_footer', 'data_route_url', 'data_program'));
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
                'program_id' => 'required',
                'route_url_id' => 'required',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama submenu kedah di isi",
                'route_url_id.required' => "Url kedah di isi",
                'pilih.required' => "pilih submenu kedah di isi",
                'program_id.required' => "program kedah di isi",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'menu_footer-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/menu_footer'), $nama);
        }
        $data = MenuFooter::find($id);
        $data->nama = $request->nama;
        $data->program_id = $request->program_id;
        $data->route_url_id = $request->route_url_id;
        $data->kategori = $request->kategori;
        $data->is_active = $request->is_active;
        $data->deskripsi = $request->deskripsi;
        if ($request->foto) {
            $data->foto = "/img/menu_footer/$nama";
        }
        if ($request->icon) {
            $data->icon = $request->icon;
        }

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data submenu atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = MenuFooter::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data submenu atos di hapus |:');
    }
}
