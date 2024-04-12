<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DataWarga;
use App\Models\FotoUser;
use App\Models\HubunganWarga;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit_data()
    {
        $user = User::find(Auth::user()->data_warga_id);
        $data_warga_ibu = DataWarga::where('jenis_kelamin', 'Perempuan')->get();
        $data_warga_ayah = DataWarga::where('jenis_kelamin', 'Laki-Laki')->get();
        $data_pribadi = DataWarga::find(Auth::user()->data_warga_id);
        $foto_pribadi = FotoUser::where('data_warga_id', Auth::user()->data_warga_id)->where('is_active', 1)->first();

        $cek_data_ayah = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Ayah');
        if ($cek_data_ayah->count() == 1) {
            $data_ayah = $cek_data_ayah->first();
            $ayah = DataWarga::find($data_ayah->data_warga_id);
            $foto_user_ayah = FotoUser::where('is_active', 1)->where('data_warga_id', $ayah->id)->first();
        } else {
            $ayah = $cek_data_ayah->get();
            $foto_user_ayah = $cek_data_ayah->get();
        }
        $cek_data_ibu = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Ibu');
        if ($cek_data_ibu->count() == 1) {
            $data_ibu = $cek_data_ibu->first();
            $ibu = DataWarga::find($data_ibu->data_warga_id);
            $foto_user_ibu = FotoUser::where('is_active', 1)->where('data_warga_id', $ibu->id)->first();
        } else {
            $ibu = $cek_data_ibu->get();
            $foto_user_ibu = $cek_data_ibu->get();
        }

        $cek_data_suami = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Suami');
        if ($cek_data_suami->count() == 1) {
            $data_suami = $cek_data_suami->first();
            $suami = DataWarga::find($data_suami->data_warga_id);
            $foto_user_suami = FotoUser::where('is_active', 1)->where('data_warga_id', $suami->id)->first();
        } else {
            $suami = $cek_data_suami->get();
            $foto_user_suami = $cek_data_suami->get();
        }

        $cek_data_istri = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Istri');
        if ($cek_data_istri->count() == 1) {
            $data_istri = $cek_data_istri->first();
            $istri = DataWarga::find($data_istri->data_warga_id);
            $foto_user_istri = FotoUser::where('is_active', 1)->where('data_warga_id', $istri->id)->first();
        } else {
            $istri = $cek_data_istri->get();
            $foto_user_istri = $cek_data_istri->get();
        }

        $cek_data_anak = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Anak');
        if ($cek_data_anak->count() == 1) {
            $data_anak = $cek_data_anak->first();
            $anak = DataWarga::find($data_anak->data_warga_id);
            $foto_user_anak = FotoUser::where('is_active', 1)->where('data_warga_id', $anak->id)->first();
        } else {
            $anak = $cek_data_anak->get();
            $foto_user_anak = $cek_data_anak->get();
        }

        $cek_data_anak_tiri = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Anak_tiri');
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
}
