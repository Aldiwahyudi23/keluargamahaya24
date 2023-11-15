<?php

namespace App\Http\Controllers;

use App\Models\AllRouteUrl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AllRouteUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_route_url.index', compact('data_route_url'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'Required|unique:all_route_urls',
                'route_name' => 'Required|unique:all_route_urls',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama kedah di isi",
                'nama.unique' => "Nama Atos Aya",
                'route_name.required' => "Route Name kedah di isi",
                'route_name.unique' => "Route Name Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = new AllRouteUrl;
        $data->nama = $request->nama;
        $data->route_name = $request->route_name;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data route url atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $route_url = AllRouteUrl::find($id);
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_route_url.show', compact('data_route_url', 'route_url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $route = AllRouteUrl::find($id);
        $data_route_url = AllRouteUrl::all();

        return view('backend.master_data.data_route_url.edit', compact('data_route_url', 'route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama' => 'Required',
                'route_name' => 'Required',
                'deskripsi' => 'Required',
            ],
            [
                'nama.required' => "Nama kedah di isi",
                'route_name.required' => "Route Name kedah di isi",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = AllRouteUrl::find($id);
        $data->nama = $request->nama;
        $data->route_name = $request->route_name;
        $data->deskripsi = $request->deskripsi;

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data route url atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = AllRouteUrl::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data route_url atos di hapus |:');
    }

    public function trash()
    {
        $data_route_url = AllRouteUrl::onlyTrashed()->get();
        return view('backend.master_data.data_route_url.trash', compact('data_route_url'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_route_url = AllRouteUrl::withTrashed()->findOrFail($id);
        $data_route_url->restore();
        return redirect()->back()->with('infoes', ' Data route_url atos di balikeun deui');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_route_url = AllRouteUrl::withTrashed()->findOrFail($id);
        $data_route_url->forceDelete();
        return redirect()->back()->with('kuning', 'Data route_url atos di hapus ');
    }
}
