<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataWarga;
use App\Models\HubunganWarga;

class KeturunanController extends Controller
{
    public function index()
    {
        $dataWarga = DataWarga::all();
        return view('keturunan.index', compact('dataWarga'));
    }

    public function cariKeturunan(Request $request)
    {
        $nama1 = $request->input('nama1');
        $nama2 = $request->input('nama2');

        $warga1 = DataWarga::where('nama', $nama1)->first();
        $warga2 = DataWarga::where('nama', $nama2)->first();

        if (!$warga1 || !$warga2) {
            return redirect()->back()->with('error', 'Nama tidak ditemukan');
        }

        $keturunan1 = $this->getKeturunan($warga1->id);
        $keturunan2 = $this->getKeturunan($warga2->id);

        $sama = array_intersect($keturunan1, $keturunan2);

        if (count($sama) > 0) {
            $keturunanSama = DataWarga::whereIn('id', $sama)->get();
            return view('keturunan.hasil', compact('keturunanSama'));
        } else {
            return redirect()->back()->with('error', 'Tidak ada keturunan yang sama');
        }
    }

    private function getKeturunan($id)
    {
        $hasil = [];
        $this->cariOrangtua($id, $hasil);
        return $hasil;
    }

    private function cariOrangtua($id, &$hasil)
    {
        $orangtua = HubunganWarga::where('warga_id', $id)->get();
        foreach ($orangtua as $ortu) {
            $hasil[] = $ortu->data_warga_id;
            $this->cariOrangtua($ortu->data_warga_id, $hasil);
        }
    }
}
