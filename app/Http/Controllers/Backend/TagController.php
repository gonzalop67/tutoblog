<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ValidarTag;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id')->get();
        return view('theme.back.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('theme.back.tag.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidarTag $request)
    {
        Tag::create($request->validated());
        // cache()->tags('Permiso')->flush();
        return redirect()->route('tag')->with('mensaje', 'Tag guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Tag::findOrFail($id);
        return view('theme.back.tag.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidarTag $request, $id)
    {
        Tag::findOrFail($id)->update($request->validated());
        // cache()->tags('Permiso')->flush(); // Clear cache after updating a permission
        return redirect()->route('tag')->with('mensaje', 'Tag actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Tag::destroy($id);
        //cache()->tags('Permiso')->flush(); // Clear cache after creating a new menu
        return redirect()->route('tag')->with('mensaje', 'Tag eliminado con éxito');
    }
}
