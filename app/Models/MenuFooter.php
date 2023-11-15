<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuFooter extends Model
{
    use HasFactory;

    public function route_url()
    {
        return $this->belongsTo(AllRouteUrl::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
