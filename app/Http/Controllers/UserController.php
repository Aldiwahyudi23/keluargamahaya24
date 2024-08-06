<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccessMenu;
use App\Models\AccessProgram;
use App\Models\LayoutAppUser;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role_id' => 'required',
                'data_warga_id' => 'required',

            ],
            [
                'nama.required' => 'Nama Kedah di isin',
                'email.required' => 'email Kedah di isin',
                'password.required' => 'password Kedah di isin',
                'role_id.required' => 'Role Kedah di isin',
                'data_warga_id.required' => 'Data Warga Kedah di isin',
            ]
        );

        $data_user = new User();
        $data_user->name = $request->name;
        $data_user->email = $request->email;
        $data_user->password = $request->password;
        $data_user->role_id = $request->role_id;
        $data_user->data_warga_id = $request->data_warga_id;

        $data_user->save();

        return redirect()->back()->with('sukse', 'Wihhhh mantap bos account atos jadi, gaskeunnn');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $data = User::find($id);
        $role = Role::all();
        $program = Program::all();
        $data_layout_app = LayoutAppUser::where('user_id', $id)->first();

        return view('backend.master_data.data_warga.data_user.index', compact('data', 'program', 'role', 'data_layout_app'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'role_id' => 'required',
            ],
            [
                'nama.required' => 'Nama Kedah di isin',
                'email.required' => 'email Kedah di isin',
                'role_id.required' => 'Role Kedah di isin',
            ]
        );

        $data_user = User::find($id);
        $data_user->name = $request->name;
        $data_user->email = $request->email;
        $data_user->role_id = $request->role_id;
        if ($request->password) {
            $data_user->password = $request->password;
        }

        $data_user->update();

        return redirect()->back()->with('infoes', 'Wahhhhh Account atos di edit, Mantap Luar biasa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function hubungkan_akun(Request $request)
    {

        $data = User::find($request->id_hub);
        if ($data->is_active == 1) {
            if ($data->user_id == False) {
                $data->user_id = $request->user_id;
                $data->update();
                return redirect()->back()->with('sukses', 'Akun atos terhubung, ayeuna akun pasangan atos tiasa data');
            } else {
                $data->user_id = 0;
                $data->update();
                return redirect()->back()->with('infoes', 'Ngahapus akses');
            }
        } else {
            return redirect()->back()->with('kuning', 'Akun Tidak dapat di hubungkan, Status Akun Teu Aktif. teu tiasa di lanjut ');
        }
    }
}
