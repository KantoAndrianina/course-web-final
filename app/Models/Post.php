<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false; 

    public function savePost($titre, $description)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->slug = Str::slug($titre);
        $this->save();

        return $this;
    }

    public static function getArticles()
    {
        $posts = DB::select('select * from posts');

        return $posts;
    }

    
}
