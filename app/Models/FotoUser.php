<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoUser extends Model
{
    use HasFactory;

    public function data_warga()
    {
        return $this->belongsTo(DataWarga::class);
    }
}
