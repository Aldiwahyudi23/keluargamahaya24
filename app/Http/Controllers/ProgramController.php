<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\Menu;
use App\Models\Role;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_program = Program::all();
        return view('backend.master_data.data_program.index', compact('data_program'));
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
        $request->validate(
            [
                'nama_program' => 'Required|unique:programs',
                'deskripsi' => 'required',
                'SnK' => 'required'

            ],
            [
                'nama_program.required'  => "Program Kedah di isian",
                'nama_program.unique'  => "Program atos aya",
                'deskripsi.required'  => "Deskripsi kedah di isi sareng detail",
                'SnK.required'  => "Syarat dan Ketentuan kedah di isi sareng detail"
            ]
        );

        $data = new Program;
        $data->nama_program     = $request->nama_program;
        $data->deskripsi        = $request->deskripsi;
        $data->SnK        = $request->SnK;

        $data->save();
        return redirect()->back()->with('sukses', 'Data Program Parantos ka simpen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_program = Program::find($id);
        $cek_access_program = AccessProgram::where('program_id', $id)->where('user_id', Auth::user()->id)->count();
        $data_menu_footer = SubMenu::where('menu_id', 2)->get();

        return view('backend.master_data.data_program.show', compact('data_program', 'data_menu_footer', 'cek_access_program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $program = Program::find($id);
        $data_program = Program::all();

        return view('backend.master_data.data_program.edit', compact('program', 'data_program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama_program' => 'Required',
                'deskripsi' => 'required',
                'SnK' => 'required'

            ],
            [
                'nama_program.required'  => "Program Kedah di isian",
                'deskripsi.required'  => "Deskripsi kedah di isi sareng detail",
                'SnK.required'  => "Syarat dan Ketentuan kedah di isi sareng detail"
            ]
        );

        $data = Program::find($id);
        $data->nama_program     = $request->nama_program;
        $data->deskripsi        = $request->deskripsi;
        $data->SnK        = $request->SnK;
        $data->jumlah        = $request->jumlah;
        $data->tanggal        = $request->tanggal;

        $data->update();
        return redirect()->back()->with('infoes', 'Data Program Parantos ka geuntos');
    }

    public function program_pilih()
    {
        $data_program = Program::all();

        return view('frontend.setting.program.program_pilih', compact('data_program'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_program = Program::find($id);

        $data_program->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_program = Program::onlyTrashed()->get();

        return view('backend.master_data.data_program.trash', compact('data_program'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_program = Program::withTrashed()->findorfail($id);
        $data_program->restore();
        return redirect()->back()->with('infoes', 'Data program atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_program = Program::withTrashed()->findorfail($id);

        $data_program->forceDelete();
        return redirect()->back()->with('kuning', 'Data program parantos di hapus dina sampah');
    }
}
