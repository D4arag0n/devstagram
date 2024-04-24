<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {

        //obtener a quienes seguimos
        $following_ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('id', $following_ids)->latest()->paginate('20');
        return view('home', [
            'posts' => $posts
        ]);
    }
}
