<?php

namespace App\Http\Controllers;

use App\Models\AccessProgram;
use App\Http\Controllers\Controller;
use App\Models\Access_Pemasukan;
use App\Models\AccessMenu;
use App\Models\DataWarga;
use App\Models\Menu;
use App\Models\Program;
use App\Models\Role;
use App\Models\SubMenu;
use App\Models\UpdateKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AccessProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_user = User::all();

        return view('backend.master_data.data_program.data_program_user.index', compact('data_user'));
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
        $user = User::find($request->user_id);
        $data_warga = DataWarga::find($user->data_warga_id);

        $data = new AccessProgram();
        $data->user_id = $request->user_id;
        $data->program_id = $request->program_id;


        $cek_access = AccessProgram::where('user_id', $request->user_id)->where('program_id', $request->program_id);
        if ($request->program_id == 1) {
            if ($data_warga->status == "Bekerja") {
                if ($cek_access->count() < 1) {
                    $data->save();
                    return redirect()->back()->with('sukses', 'Wahhhhh Mantappp luar biasa atos bergabung kana program');
                } else {
                    $cek_access->forceDelete();
                    return redirect()->back()->with('kuning', 'Yahhhhhh Akses kana program atos di putus');
                }

                $update = new UpdateKerja();
                $update->user_id = $request->user_id;
                $update->status = $request->status;

                $update->save();
            }
        } else {
            if ($cek_access->count() < 1) {
                $data->save();
                return redirect()->back()->with('sukses', 'Wahhhhh Mantappp luar biasa atos bergabung kana program');
            } else {
                $cek_access->forceDelete();
                return redirect()->back()->with('kuning', 'Yahhhhhh Akses kana program atos di putus');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessProgram $accessProgram)
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
        $data_program = Program::all();
        $data_access_program = SubMenu::where('menu_id', 2)->get();

        return view('backend.setting.menu_footer.access', compact('data_user', 'data_program', 'data_access_program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessProgram $accessProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessProgram $accessProgram)
    {
        //
    }
}
