<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function route_url()
    {
        return $this->belongsTo(AllRouteUrl::class);
    }
}
