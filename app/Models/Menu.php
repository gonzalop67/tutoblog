<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'menus_roles', 'menus_id', 'roles_id');
    }

    private function getMenuPadres($front)
    {
        if ($front) {
            return $this->whereHas('roles', function($query){
                $query->where('rol_id', session('rol_id'))->orderby('menus_id');
            })->orderby('menus_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('menus_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        }
    }

    
}
