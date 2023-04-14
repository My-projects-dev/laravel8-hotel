<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index($language='en')
    {
        $blogs = Blog::with(['blogTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->paginate(11);

        return view('frontend.pages.blog.blog_category', compact('blogs'));
    }

    public function show($language='en', $slug)
    {
        $blog = BlogTranslation::with('parentBlog')->where(['slug' => $slug])->first();
        return view('frontend.pages.blog.blog_item', compact('blog'));
    }
}
