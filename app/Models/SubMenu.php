<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "sub_menus";

    protected $fillable = [
        'id',
        'nama',
        'menu_is',
        'route_url_id',
        'icon',
        'is_active',
        'deskripsi',
    ];

    public function route_url()
    {
        return $this->belongsTo(AllRouteUrl::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
