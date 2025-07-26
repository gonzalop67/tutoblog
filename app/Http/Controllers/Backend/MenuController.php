<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Menu;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ValidacionMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::getMenu();
        return view('theme.back.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.menu.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionMenu $request)
    {
        $validado = $request->validated();
        Menu::create($validado);
        cache()->tags('Menu')->flush(); // Clear cache after creating a new menu
        return redirect()->route('menu.crear')->with('mensaje', 'Menu guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Menu::findOrFail($id);
        return view('theme.back.menu.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionMenu $request, $id)
    {
        Menu::findOrFail($id)->update($request->validated());
        cache()->tags('Menu')->flush(); // Clear cache after creating a new menu
        return redirect()->route('menu')->with('mensaje', 'Menú actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Menu::destroy($id);
        cache()->tags('Menu')->flush(); // Clear cache after creating a new menu
        return redirect()->route('menu')->with('mensaje', 'Menú eliminado con éxito');
    }

    public function guardarOrden(Request $request)
    {
        if ($request->ajax()) {
            Menu::guardarOrden($request->menu);
            cache()->tags('Menu')->flush(); // Clear cache after creating a new menu
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }
}
