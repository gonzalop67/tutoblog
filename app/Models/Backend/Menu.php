<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menu";
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'menu_rol', 'menu_id', 'rol_id');
    }

    private function getMenuPadres($front)
    {
        if ($front) {
            return $this->whereHas('roles', function ($query) {
                $query->where('rol_id', session('rol_id'))->orderby('menu_id');
            })->orderby('menu_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('menu_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        }
    }

    private function getMenuHijos($padres, $line)
    {
        $hijos = [];
        foreach ($padres as $line2) {
            if ($line['id'] == $line2['menu_id']) {
                $hijos = array_merge($hijos, [array_merge($line2, ['submenu' => $this->getMenuHijos($padres, $line2)])]);
            }
        }
        return $hijos;
    }

    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $padres = $menus->getMenuPadres($front);
        $menuAll = [];
        foreach ($padres as $line) {
            if ($line['menu_id'] != null)
                break;
            $item = [array_merge($line, ['submenu' => $menus->getMenuHijos($padres, $line)])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    public static function guardarOrden($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $menu) {
            self::where('id', $menu->id)->update(['menu_id' => null, 'orden' => $var + 1]);
            if (!empty($menu->children)) {
                self::guardarOrdenHijos($menu->children, $menu);
            }
        }
    }

    public static function guardarOrdenHijos($hijos, $padre)
    {
        foreach ($hijos as $key => $hijo) {
            self::where('id', $hijo->id)->update(['menu_id' => $padre->id, 'orden' => $key + 1]);
            if (!empty($hijo->children)) {
                self::guardarOrdenHijos($hijo->children, $hijo);
            }
        }
    }
}
