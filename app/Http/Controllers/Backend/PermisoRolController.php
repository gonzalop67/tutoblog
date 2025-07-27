<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Permiso;
use App\Models\Backend\Rol;
use Illuminate\Http\Request;

class PermisoRolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::orderBy('id')->pluck('nombre', 'id');
        $permisos = Permiso::with('roles')->orderBy('id')->get();
        $permisosRols = Permiso::with('roles')->get()->pluck('roles', 'id')->toArray();
        return view('theme.back.permiso-rol.index', compact('roles', 'permisos', 'permisosRols'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        if ($request->ajax()) {
            $permiso = Permiso::findOrFail($request->permiso_id);
            cache()->tags('Permiso')->flush();
            if ($request->estado == 1) {
                $permiso->roles()->attach($request->rol_id);
                return response()->json(['respuesta' => 'El rol se asignó correctamente.']);
            } else {
                $permiso->roles()->detach($request->rol_id);
                return response()->json(['respuesta' => 'El rol se eliminó correctamente.']);
            }
        } else {
            abort(404);
        }
    }
}
