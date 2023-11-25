<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kredit extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function data_warga()
    {
        return $this->belongsTo(DataWarga::class);
    }
}
