<?php

namespace App\Http\Controllers;

use App\Eloquent\Blog\Category;
use App\Eloquent\Blog\Post;
use App\Eloquent\Blog\Tag;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index()
    {
        $not_show_header = true;
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::all();
        return view('portfolio.blog', compact('not_show_header', 'categories', 'tags', 'posts'));
    }

    public function getPost()
    {
        $not_show_header = true;
        return view('portfolio.post', compact('not_show_header'));
    }
}
