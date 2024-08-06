<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataWarga extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function hubungan()
    {
        return $this->hasMany(HubunganWarga::class, 'warga_id');
    }

    public function keturunan()
    {
        return $this->hasMany(HubunganWarga::class, 'data_warga_id');
    }
}
