<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = ['usuario_id', 'titulo', 'slug', 'descripcion', 'contenido', 'estado'];

    public function categoria()
    {
        return $this->belongsToMany(Categoria::class, 'post_categoria');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function archivo()
    {
        return $this->morphOne(Archivo::class, 'archivable');
    }
}
