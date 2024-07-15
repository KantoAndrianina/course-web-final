<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function accueil()
    {
        $posts = Post::getArticles();

        return view('front.accueil', ['posts' => $posts]);
    }
    public function creerArticle()
    {
        return view('front.creer_article');
    }

    public function store(Request $request)
    {
        $titre = $request->input('titre');
        $description = $request->input('description');

        $post = (new Post())->savePost($titre, $description);
        // echo $titre . ' ';
        // echo $description. ' ';

        return redirect()->route('accueil')->with('success', 'Déconnexion réussie.');
        // return response()->json($post, 201); 
        // return view('test');
        
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('front.article', compact('post'));
    }
}
