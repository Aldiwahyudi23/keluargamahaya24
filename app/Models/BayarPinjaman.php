<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BayarPinjaman extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function pengurus()
    {
        return $this->belongsTo(DataWarga::class);
    }
    public function pengaju()
    {
        return $this->belongsTo(DataWarga::class);
    }
    public function data_warga()
    {
        return $this->belongsTo(DataWarga::class);
    }
    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class);
    }
}
