<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ValidarPost;
use App\Models\Backend\Categoria;
use App\Models\Backend\Post;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get(); // Assuming you have a Post model
        return view('theme.back.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $categorias = Categoria::orderBy('id')->pluck('nombre', 'id');
        $tags = Tag::orderBy('id')->pluck('nombre', 'id');
        return view('theme.back.post.crear', compact('categorias', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidarPost $request)
    {
        // dd($request->validated());
        $post = Post::create($request->validated());
        $categorias = $request->categoria;
        $post->categoria()->attach(array_values($categorias)); // Se relacionan las categorías
        $tags = $request->tag ? Tag::setTag($request->tag) : [];
        $post->tag()->attach($tags); // Se relacionan las etiquetas
        /*
        * Trabajo con las imágenes
        */
        if ($imagen = $request->imagen) {
            $folder = "imagen_post";
            $peso = $imagen->getSize();
            $extension = $imagen->extension();
            $ruta = Storage::disk('public')->put($folder, $imagen);
            $post->archivo()->create([
                'ruta' => $ruta,
                'peso' => $peso,
                'extension' => $extension,
            ]);
        }
        return redirect()->route('post')->with('mensaje', 'Post guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar(Post $post, Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {
            return view('theme.back.post.mostrar', compact('post'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Post $post)
    {
        $categorias = Categoria::orderBy('id')->pluck('nombre', 'id');
        $tags = Tag::orderBy('id')->pluck('nombre', 'id');
        return view('theme.back.post.editar', compact('post', 'categorias', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidarPost $request, Post $post)
    {
        $post->update($request->validated());
        $categorias = $request->categoria;
        $post->categoria()->sync(array_values($categorias)); // Se relacionan las categorías
        $tags = $request->tag ? Tag::setTag($request->tag) : [];
        $post->tag()->sync($tags); // Se relacionan las etiquetas
        /*
        * Trabajo con las imágenes
        */
        if ($imagen = $request->imagen) {
            $folder = "imagen_post";
            Storage::disk('public')->delete($post->archivo->ruta); // Eliminar la imagen anterior
            $post->archivo()->delete(); // Eliminar el registro del archivo anterior
            $peso = $imagen->getSize();
            $extension = $imagen->extension();
            $ruta = Storage::disk('public')->put($folder, $imagen);
            $post->archivo()->create([
                'ruta' => $ruta,
                'peso' => $peso,
                'extension' => $extension,
            ]);
        }
        return redirect()->route('post')->with('mensaje', 'Post actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Post $post)
    {
        //
    }
}
