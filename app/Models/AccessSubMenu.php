<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessSubMenu extends Model
{
    use HasFactory;

    public function sub_menu()
    {
        return $this->belongsTo(SubMenu::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
