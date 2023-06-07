<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact.contact');
    }

    public function store($language = 'en', CommentRequest $request)
    {
        $validated = $request->validated();
        Comment::create($validated);
        createComment();
        return redirect()->back()->with('success', 'Created successfully.');
    }
}
