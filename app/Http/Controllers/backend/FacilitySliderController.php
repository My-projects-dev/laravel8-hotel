<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacilitySliderStoreRequest;
use App\Http\Requests\FacilitySliderUpdateRequest;
use App\Models\FacilitySlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FacilitySliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of facility sliders';
        $sliders = FacilitySlider::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.facility_slider.index', compact('sliders', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $page = 'Create facility slider';
        return view('backend.pages.facility_slider.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacilitySliderStoreRequest $request
     * @return RedirectResponse
     */
    public function store(FacilitySliderStoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/facility_slider'), $imageName);
                $validated['image'] = $imageName;
            }

            FacilitySlider::create($validated);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/facility_slider/' . $validated['image']))) {
                File::delete(public_path('uploads/facility_slider/' . $validated['image']));
            }
            return redirect()->back()->with('error', "Failed operation");
        }
        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param FacilitySlider $slider
     * @return void
     */
    public function show(FacilitySlider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        $page = 'Edit facility slider';
        $slider = FacilitySlider::find($id);
        return view('backend.pages.facility_slider.edit', compact('slider', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacilitySliderUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */


    public function update(FacilitySliderUpdateRequest $request, int $id): RedirectResponse
    {
        $slider = FacilitySlider::find($id);
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/facility_slider'), $imageName);
                $validated['image'] = $imageName;
                $old_img = $slider->image;
            }

            $slider->update($validated);

            if ($slider->wasChanged('image')) {
                if (File::exists(public_path('uploads/facility_slider/' . $old_img))) {
                    File::delete(public_path('uploads/facility_slider/' . $old_img));
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
     * @param FacilitySlider $slider
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $slider = FacilitySlider::find($id);
        $old_img = $slider->image;
        $delete = $slider->delete();
        if ($delete and File::exists(public_path('uploads/facility_slider/' . $old_img))) {
            File::delete(public_path('uploads/facility_slider/' . $old_img));
            return redirect()->route('facility_slider.index')->with('success', 'Success');
        }

        return redirect()->route('facility_slider.index')->with('error', 'Failed operation');
    }
}
