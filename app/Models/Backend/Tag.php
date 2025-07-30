<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tag';
    protected $guarded = [];

    public static function setTag($tags)
    {
        $data = [];
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                if (is_numeric($tag)) {
                    $data[] = $tag; // If it's already an ID, just add it
                } else {
                    $tag = ucfirst(trim($tag)); // Capitalize the tag
                    $slug = Str::slug($tag, '-'); // Create a slug
                    $data[] = tag::firstOrCreate([
                        'nombre' => $tag,
                        'slug' => $slug
                    ])->id; // Create or find the tag and get its ID
                }
            }
        }
        return $data;
    }
}
