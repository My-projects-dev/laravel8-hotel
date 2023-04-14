<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NearByStoreRequest;
use App\Http\Requests\NearByUpdateRequest;
use App\Models\NearBy;
use App\Models\NearByTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NearByController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of nearby';
        $nearbies = NearByTranslation::with('parentNear')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.nearby.index', compact('nearbies', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create nearby';
        $languages = config('translatable.locales');
        return view('backend.pages.nearby.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NearByStoreRequest $request
     * @return RedirectResponse
     */
    public function store(NearByStoreRequest $request)
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
                $request->image->move(public_path('uploads/nearbies'), $imageName);
                $data['image'] = $imageName;
            }
            $near_id = NearBy::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'button_url' => $validated['button_url'][$i],
                    'button_title' => $validated["button_title"][$i],
                    'near_id' => $near_id
                ];
                array_push($translate_data, $datas);
            }

            NearByTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/nearbies/' . $data['image']))) {
                File::delete(public_path('uploads/nearbies/' . $data['image']));
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
        $page = 'Edit nearby';
        $languages = config('translatable.locales');
        $nearbies = NearByTranslation::with('parentNear')->where(['near_id' => $id])->get();

        return view('backend.pages.nearby.edit', compact('nearbies', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NearByUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(NearByUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = NearByTranslation::find($id);
        $near_id = $translation->near_id;
        $nearby = NearBy::find($near_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 1000) . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/nearbies'), $imageName);
                $data['image'] = $imageName;

                $old_img = $nearby->image;
            }

            $nearby->update($data);
            $translation->update($validated);

            if ($nearby->wasChanged('image')) {
                if (File::exists(public_path('uploads/nearbies/' . $old_img))) {
                    File::delete(public_path('uploads/nearbies/' . $old_img));
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
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $nearby = NearBy::find($id);
        $old_img = $nearby->image;
        $nearby->delete();
        if (File::exists(public_path('uploads/nearbies/' . $old_img))) {
            File::delete(public_path('uploads/nearbies/' . $old_img));
        }

        return redirect()->route('near.index')->with('success', 'Success');
    }
}
