<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ValidacionPermiso;
use App\Models\Backend\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::orderBy('id')->get();
        return view('theme.back.permiso.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.permiso.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionPermiso $request)
    {
        Permiso::create($request->validated());
        cache()->tags('Permiso')->flush(); // Clear cache after creating a new menu
        return redirect()->route('permiso')->with('mensaje', 'Permiso guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Permiso::findOrFail($id);
        return view('theme.back.permiso.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionPermiso $request, $id)
    {
        Permiso::findOrFail($id)->update($request->validated());
        cache()->tags('Permiso')->flush(); // Clear cache after updating a permission
        return redirect()->route('permiso')->with('mensaje', 'Permiso actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Permiso::destroy($id);
        cache()->tags('Permiso')->flush(); // Clear cache after creating a new menu
        return redirect()->route('permiso')->with('mensaje', 'Permiso eliminado con éxito');
    }
}
