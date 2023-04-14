<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $page = 'List of slider';
        $sliders = SliderTranslation::with('parentSlider')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.sliders.index', compact('sliders', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $page = 'Create slider';
        $languages = config('translatable.locales');
        return view('backend.pages.sliders.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SliderStoreRequest $request)
    {
        $lang = config('translatable.locales');
        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['status'] = $validated['status'];
        $data['star'] = $validated['star'];


        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/sliders'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['slider_id'] = Slider::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'title' => $validated['title'][$i],
                    'subtitle' => $validated['subtitle'][$i],
                    'button_title' => $validated['button_title'][$i],
                    'button_url' => $validated['button_url'][$i],
                    'slider_id' => $validated['slider_id']
                ];
                array_push($translate_data, $datas);
            }

            SliderTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/sliders/' . $data['image']))) {
                File::delete(public_path('uploads/sliders/' . $data['image']));
            }

            return redirect()->back()->with('error', "Failed operation");
        }
        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return void
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $page = 'Edit slider';
        $languages = config('translatable.locales');
        $sliders = SliderTranslation::with('parentSlider')->where(['slider_id' => $id])->get();
        return view('backend.pages.sliders.edit', compact('sliders', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SliderUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = SliderTranslation::find($id);
        $slider_id = $translation->slider_id;
        $slider = Slider::find($slider_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];
        $data['star'] = $validated['star'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/sliders'), $imageName);
                $data['image'] = $imageName;

                $old_img = $slider->image;
            }

            $slider->update($data);
            $translation->update($validated);

            if ($slider->wasChanged('image')) {
                if (File::exists(public_path('uploads/sliders/' . $old_img))) {
                    File::delete(public_path('uploads/sliders/' . $old_img));
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
     * @param Slider $slider
     * @return RedirectResponse
     */
    public function destroy(Slider $slider)
    {
        $old_img = $slider->image;
        $slider->delete();
        if (File::exists(public_path('uploads/sliders/' . $old_img))) {
            File::delete(public_path('uploads/sliders/' . $old_img));
        }

        return redirect()->route('slider.index')->with('success', 'Success');
    }
}
