<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'List of blog';
        $blogs = BlogTranslation::with('parentBlog')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.blog.index', compact('blogs', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create blog';
        $languages = config('translatable.locales');
        return view('backend.pages.blog.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BlogStoreRequest $request)
    {
        $lang = config('translatable.locales');

        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/blogs'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['blog_id'] = Blog::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'slug' => $validated['slug'][$i],
                    'title' => $validated["title"][$i],
                    'content' => $validated["content"][$i],
                    'blog_id' => $validated['blog_id']
                ];
                array_push($translate_data, $datas);
            }

            BlogTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/blogs/' . $data['image']))) {
                File::delete(public_path('uploads/blogs/' . $data['image']));
            }

            return redirect()->back()->with('error', "$e");
        }
        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $page = 'Edit blog';
        $languages = config('translatable.locales');
        $blogs = BlogTranslation::with('parentBlog')->where(['blog_id' => $id])->get();

        return view('backend.pages.blog.edit', compact('blogs', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BlogUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = BlogTranslation::find($id);
        $blog_id = $translation->blog_id;
        $blog = Blog::find($blog_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/blogs'), $imageName);
                $data['image'] = $imageName;

                $old_img = $blog->image;
            }

            $blog->update($data);
            $translation->update($validated);

            if ($blog->wasChanged('image')) {
                if (File::exists(public_path('uploads/blogs/' . $old_img))) {
                    File::delete(public_path('uploads/blogs/' . $old_img));
                }
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Failed operation");
        }

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Blog $blog)
    {
        $old_img = $blog->image;
        $blog->delete();
        if (File::exists(public_path('uploads/blogs/' . $old_img))) {
            File::delete(public_path('uploads/blogs/' . $old_img));
        }

        return redirect()->route('blog.index')->with('success', 'Success');
    }
}
