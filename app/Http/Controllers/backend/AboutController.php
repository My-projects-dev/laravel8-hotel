<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;
use App\Models\About;
use App\Models\AboutImage;
use App\Models\AboutTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Edit about';
        $languages = config('translatable.locales');
        $about = About::count();

        if ($about > 0) {
            $id = About::latest()->first()->id;
            return redirect()->route('about.edit', $id);
        }

        return view('backend.pages.about.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AboutStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AboutStoreRequest $request)
    {
        $lang = config('translatable.locales');
        $validated = $request->validated();
        $status['status'] = $validated['status'];
        $translate_data = [];
        $images = [];

        try {
            DB::beginTransaction();

            $about_id = About::create($status)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $data = [
                    'language' => $lang[$i],
                    'content' => $validated['content'][$i],
                    'about_id' => $about_id,
                ];
                array_push($translate_data, $data);
            }

            AboutTranslation::insert($translate_data);

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 10000) . '.' . $file->extension();
                    $file->move(public_path('uploads/abouts'), $name);
                    $img = [
                        'about_id' => $about_id,
                        'image' => $name,
                    ];
                    array_push($images, $img);
                }
            }

            AboutImage::insert($images);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (array_key_exists('image', $images)) {
                for ($i = 0; $i <= count($images['image']); $i++) {
                    if (File::exists(public_path('uploads/abouts/' . $images['image'][$i]))) {
                        File::delete(public_path('uploads/abouts/' . $images['image'][$i]));
                    }
                }
            }
            return redirect()->back()->with('error', "Failed operation");
        }

        return redirect()->route('about.edit', $about_id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit about';
        $languages = config('translatable.locales');
        $abouts = AboutTranslation::with(['parentAbout', 'parentAbout.aboutImage'])->where(['about_id' => $id])->get();
        return view('backend.pages.about.edit', compact('abouts', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutUpdateRequest $request, int $id)
    {

        $translation = AboutTranslation::find($id);
        $about_id = $translation->about_id;
        $about = About::find($about_id);
        $validated = $request->validated();
        $status['status'] = $validated['status'];
        $content['content'] = $validated['content'];
        $images = [];

        try {
            DB::beginTransaction();

            $about->update($status);
            $translation->update($content);
            $image = new AboutImage;

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 1000) . '.' . $file->extension();
                    $file->move(public_path('uploads/abouts'), $name);
                    $img = [
                        'about_id' => $about_id,
                        'image' => $name,
                    ];
                    $images[] = $img;
                }
                $image::insert($images);
            }

            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $key => $file) {
                    $name = time() . rand(1, 1000) . '.' . $file->extension();
                    $file->move(public_path('uploads/abouts'), $name);
                    $img = ['image' => $name];
                    $img_id = $validated["id"][$key];

                    $old_img = $image->where(['about_id' => $about_id, 'id' => $img_id])->value('image');
                    $upd = $image->where(['about_id' => $about_id, 'id' => $img_id])->update($img);

                    if ($upd and File::exists(public_path('uploads/abouts/' . $old_img))) {
                        File::delete(public_path('uploads/abouts/' . $old_img));
                    }
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "$e");
        }

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
