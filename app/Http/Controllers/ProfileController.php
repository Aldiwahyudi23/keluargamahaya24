<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataWarga;
use App\Models\FotoUser;
use App\Models\HubunganWarga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UpdateKerja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_warga = DataWarga::find(Auth::user()->data_warga_id);
        $data_akun = User::where('data_warga_id', Auth::user()->data_warga_id)->first();
        $foto = FotoUser::orderByRaw('created_at DESC')->where('data_warga_id', Auth::user()->data_warga_id);
        $kerja = UpdateKerja::orderByRaw('created_at DESC')->where('user_id', Auth::user()->id)->get();

        $cek_data_hubungan = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->get();

        return view('frontend.profile.index', compact('data_warga', 'data_akun', 'foto', 'cek_data_hubungan', 'kerja')); //tidak aktive
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function edit_data()
    {
        $user = User::find(Auth::user()->data_warga_id);
        $data_warga = DataWarga::all();
        $data_warga_ibu = DataWarga::where('jenis_kelamin', 'Perempuan')->get();
        $data_warga_ayah = DataWarga::where('jenis_kelamin', 'Laki-Laki')->get();
        $data_pribadi = DataWarga::find(Auth::user()->data_warga_id);
        $foto_pribadi = FotoUser::where('data_warga_id', Auth::user()->data_warga_id)->where('is_active', 1)->first();

        $cek_data_ayah = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Ayah');
        if ($cek_data_ayah->count() == 1) {
            $data_ayah = $cek_data_ayah->first();
            $ayah = DataWarga::find($data_ayah->data_warga_id);
            $foto_user_ayah = FotoUser::where('is_active', 1)->where('data_warga_id', $ayah->id)->first();
        } else {
            $ayah = $cek_data_ayah->get();
            $foto_user_ayah = $cek_data_ayah->get();
        }
        $cek_data_ibu = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Ibu');
        if ($cek_data_ibu->count() == 1) {
            $data_ibu = $cek_data_ibu->first();
            $ibu = DataWarga::find($data_ibu->data_warga_id);
            $foto_user_ibu = FotoUser::where('is_active', 1)->where('data_warga_id', $ibu->id)->first();
        } else {
            $ibu = $cek_data_ibu->get();
            $foto_user_ibu = $cek_data_ibu->get();
        }

        $cek_data_suami = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Suami');
        if ($cek_data_suami->count() == 1) {
            $data_suami = $cek_data_suami->first();
            $suami = DataWarga::find($data_suami->data_warga_id);
            $foto_user_suami = FotoUser::where('is_active', 1)->where('data_warga_id', $suami->id)->first();
        } else {
            $suami = $cek_data_suami->get();
            $foto_user_suami = $cek_data_suami->get();
        }

        $cek_data_istri = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Istri');
        if ($cek_data_istri->count() == 1) {
            $data_istri = $cek_data_istri->first();
            $istri = DataWarga::find($data_istri->data_warga_id);
            $foto_user_istri = FotoUser::where('is_active', 1)->where('data_warga_id', $istri->id)->first();
        } else {
            $istri = $cek_data_istri->get();
            $foto_user_istri = $cek_data_istri->get();
        }

        $cek_data_anak = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Anak');
        if ($cek_data_anak->count() == 1) {
            $data_anak = $cek_data_anak->first();
            $anak = DataWarga::find($data_anak->data_warga_id);
            $foto_user_anak = FotoUser::where('is_active', 1)->where('data_warga_id', $anak->id)->first();
        } else {
            $anak = $cek_data_anak->get();
            $foto_user_anak = $cek_data_anak->get();
        }

        $cek_data_anak_tiri = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->where('hubungan', 'Anak_tiri');
        if ($cek_data_anak_tiri->count() == 1) {
            $data_anak_tiri = $cek_data_anak_tiri->first();
            $anak_tiri = DataWarga::find($data_anak_tiri->data_warga_id);
            $foto_user_anak_tiri = FotoUser::where('is_active', 1)->where('data_warga_id', $anak_tiri->id)->first();
        } else {
            $anak_tiri = $cek_data_anak_tiri->get();
            $foto_user_anak_tiri = $cek_data_anak_tiri->get();
        }

        $foto_user = FotoUser::where('is-active', 1);



        return view('profile.edit_data', compact(
            'data_pribadi',
            'cek_data_ayah',
            'cek_data_ibu',
            'data_warga_ayah',
            'data_warga_ibu',
            'data_warga',
            'ayah',
            'ibu',
            'foto_user',
            'foto_user_ibu',
            'foto_user_ayah',
            'foto_pribadi',
            'suami',
            'foto_user_suami',
            'istri',
            'anak',
            'anak_tiri',
            'foto_user_istri',
            'foto_user_anak',
            'foto_user_anak_tiri',
            'cek_data_suami',
            'cek_data_istri',
            'cek_data_anak',
            'cek_data_anak_tiri',
        ));
    }

    public function edit_email()
    {
        return view('frontend.profile.email');
    }

    public function ubah_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email'
        ]);
        $user = User::findorfail(Auth::user()->id);
        $cekUser = User::where('email', $request->email)->count();
        if ($cekUser >= 1) {
            return redirect()->back()->with('error', 'Maaf email ini sudah terdaftar!');
        } else {
            $user_email = [
                'email' => $request->email,
            ];
            $user->update($user_email);

            return redirect()->back()->with('success', 'Email anda berhasil diperbarui!');
        }
    }

    public function edit_password()
    {
        return view('frontend.profile.password');
    }

    public function ubah_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::findorfail(Auth::user()->id);
        if ($request->password_lama) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_lama == $request->password) {
                    return redirect()->back()->with('error', 'Maaf password yang anda masukkan sama!');
                } else {
                    $user_password = [
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_password);
                    return redirect()->back()->with('success', 'Password anda berhasil diperbarui!');
                }
            } else {
                return redirect()->back()->with('error', 'Tolong masukkan password lama anda dengan benar!');
            }
        } else {
            return redirect()->back()->with('error', 'Tolong masukkan password lama anda terlebih dahulu!');
        }
    }

    public function data_hubungan_anak($id)
    {
        $id = Crypt::decrypt($id);
        $anak = DataWarga::find($id);
        $foto_user_anak = FotoUser::where('is_active', 1)->where('data_warga_id', $anak->id)->first();

        return view('profile.form_profile.form_anak', compact('anak', 'foto_user_anak'));
    }
}
