<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacilityStoreRequest;
use App\Http\Requests\FacilityUpdateRequest;
use App\Models\Facility;
use App\Models\FacilityTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of facility';
        $facilities = FacilityTranslation::with('parentFacility')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.facility.index', compact('facilities', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create facility';
        $languages = config('translatable.locales');
        return view('backend.pages.facility.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
'.'.     * @param FacilityStoreRequest $request
     * @return RedirectResponse
     */
    public function store(FacilityStoreRequest $request)
    {
        $lang = config('translatable.locales');

        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 1000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/facilities'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['facility_id'] = Facility::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'title' => $validated["title"][$i],
                    'description' => $validated["description"][$i],
                    'facility_id' => $validated['facility_id']
                ];
                array_push($translate_data, $datas);
            }

            FacilityTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/facilities/' . $data['image']))) {
                File::delete(public_path('uploads/facilities/' . $data['image']));
            }

            return redirect()->back()->with('error', "Failed operation");
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
        $page = 'Edit facility';
        $languages = config('translatable.locales');
        $facilities = FacilityTranslation::with('parentFacility')->where(['facility_id' => $id])->get();

        return view('backend.pages.facility.edit', compact('facilities', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(FacilityUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = FacilityTranslation::find($id);
        $facility_id = $translation->facility_id;
        $facility = Facility::find($facility_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 1000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/facilities'), $imageName);
                $data['image'] = $imageName;

                $old_img = $facility->image;
            }

            $facility->update($data);
            $translation->update($validated);

            if ($facility->wasChanged('image')) {
                if (File::exists(public_path('uploads/facilities/' . $old_img))) {
                    File::delete(public_path('uploads/facilities/' . $old_img));
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
    public function destroy(Facility $facility)
    {
        $old_img = $facility->image;
        $facility->delete();
        if (File::exists(public_path('uploads/facilities/' . $old_img))) {
            File::delete(public_path('uploads/facilities/' . $old_img));
        }

        return redirect()->route('facility.index')->with('success', 'Success');
    }
}
