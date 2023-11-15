<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessMenu extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
