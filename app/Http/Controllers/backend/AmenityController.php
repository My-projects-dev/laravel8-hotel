<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmenityStoreRequest;
use App\Http\Requests\AmenityUpdateRequest;
use App\Models\Amenity;
use App\Models\AmenityTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'List of room amenity';
        $amenities = AmenityTranslation::with('parentAmenity')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.amenity.index', compact('amenities','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create room amenity';
        $languages = config('translatable.locales');
        return view('backend.pages.amenity.create', compact('page','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AmenityStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AmenityStoreRequest $request)
    {
        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['icon'] = $validated['icon'];
        $data['status'] = $validated['status'];
        $lang = config('translatable.locales');


        try {
            DB::beginTransaction();

            $validated['amenity_id'] = Amenity::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'title' => $validated['title'][$i],
                    'amenity_id' => $validated['amenity_id']
                ];
                array_push($translate_data, $datas);
            }

            AmenityTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
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
        $page = 'Edit room amenity';
        $languages = config('translatable.locales');
        $amenities = AmenityTranslation::with('parentAmenity')->where(['amenity_id'=>$id])->get();
        return view('backend.pages.amenity.edit', compact('amenities','page','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AmenityUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AmenityUpdateRequest $request, int $id)
    {
        $translation = AmenityTranslation::find($id);
        $amenity_id = $translation->amenity_id;
        $amenity = Amenity::find($amenity_id);
        $validated = $request->validated();
        $data = [];
        $data['icon'] = $validated['icon'];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            $amenity->update($data);
            $translation->update($validated);
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
     * @param Amenity $amenity
     * @return Response
     */
    public function destroy(Amenity $amenity)
    {
        $delete = $amenity->delete();
        if ($delete){
            return redirect()->route('amenity.index')->with('success', 'Success');
        }

        return redirect()->route('amenity.index')->with('error', "Failed operation");
    }
}
