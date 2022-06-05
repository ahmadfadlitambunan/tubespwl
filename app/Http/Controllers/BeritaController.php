<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $title = '';

        if(request('search')){
            $title = " '" .request('search'). "'" ;
        }

        if(request('category')){
            $category = Category::firstWhere('id', request('category'));
            $title = " di ". $category->name;
        }

        if(request('author')){
            $author = User::firstWhere('id', request('author'));
            $title = ' oleh '. $author->name;
        }

        return view('berita.index', [
            "title" => "Semua Berita" . $title,
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->get()
        ]);
    }

    public function show(Post $post)
    {
        return view('berita.berita', [
            'post'=> $post
        ]);
    }
}
