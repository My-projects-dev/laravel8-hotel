<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelInfoStoreRequest;
use App\Http\Requests\HotelInfoUpdateRequest;
use App\Models\HotelInformation;
use App\Models\HotelInformationTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HotelInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of info';
        $informations = HotelInformationTranslation::with('parentInfo')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.info.index', compact('informations', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create info';
        $languages = config('translatable.locales');
        return view('backend.pages.info.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HotelInfoStoreRequest $request
     * @return RedirectResponse
     */
    public function store(HotelInfoStoreRequest $request)
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
                $request->image->move(public_path('uploads/info'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['info_id'] = HotelInformation::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'title' => $validated["title"][$i],
                    'content' => $validated["content"][$i],
                    'info_id' => $validated['info_id']
                ];
                array_push($translate_data, $datas);
            }

            HotelInformationTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/info/' . $data['image']))) {
                File::delete(public_path('uploads/info/' . $data['image']));
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
        $page = 'Edit info';
        $languages = config('translatable.locales');
        $info = HotelInformationTranslation::with('parentInfo')->where(['info_id' => $id])->get();

        return view('backend.pages.info.edit', compact('info', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HotelInfoUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(HotelInfoUpdateRequest $request, int $id)
    {
        $translation = HotelInformationTranslation::find($id);
        $info_id = $translation->info_id;
        $info = HotelInformation::find($info_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/info'), $imageName);
                $data['image'] = $imageName;

                $old_img = $info->image;
            }

            $info->update($data);
            $translation->update($validated);

            if ($info->wasChanged('image')) {
                if (File::exists(public_path('uploads/info/' . $old_img))) {
                    File::delete(public_path('uploads/info/' . $old_img));
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
    public function destroy(HotelInformation $info)
    {
        $old_img = $info->image;
        $info->delete();
        if (File::exists(public_path('uploads/info/' . $old_img))) {
            File::delete(public_path('uploads/info/' . $old_img));
        }

        return redirect()->route('info.index')->with('success', 'Success');
    }
}
