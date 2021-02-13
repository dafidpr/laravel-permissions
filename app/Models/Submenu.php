<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id','title','url','target', 'position','created_by','updated_by'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
