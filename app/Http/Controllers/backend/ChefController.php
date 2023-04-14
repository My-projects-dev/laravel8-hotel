<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChefStoreRequest;
use App\Http\Requests\ChefUpdateRequest;
use App\Models\Chef;
use App\Models\ChefTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of chef';
        $chefs = ChefTranslation::with('parentChef')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.chef.index', compact('chefs', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create chef info';
        $languages = config('translatable.locales');
        return view('backend.pages.chef.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ChefStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ChefStoreRequest $request)
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
                $request->image->move(public_path('uploads/chefs'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['chef_id'] = Chef::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'position' => $validated['position'][$i],
                    'full_name' => $validated["full_name"][$i],
                    'about' => $validated["about"][$i],
                    'chef_id' => $validated['chef_id']
                ];
                array_push($translate_data, $datas);
            }

            ChefTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/chefs/' . $data['image']))) {
                File::delete(public_path('uploads/chefs/' . $data['image']));
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
        $page = 'Edit chef';
        $languages = config('translatable.locales');
        $chefs = ChefTranslation::with('parentChef')->where(['chef_id' => $id])->get();

        return view('backend.pages.chef.edit', compact('chefs', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ChefUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = ChefTranslation::find($id);
        $chef_id = $translation->chef_id;
        $chef = Chef::find($chef_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/chefs'), $imageName);
                $data['image'] = $imageName;

                $old_img = $chef->image;
            }

            $chef->update($data);
            $translation->update($validated);

            if ($chef->wasChanged('image')) {
                if (File::exists(public_path('uploads/chefs/' . $old_img))) {
                    File::delete(public_path('uploads/chefs/' . $old_img));
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
    public function destroy(Chef $chef)
    {
        $old_img = $chef->image;
        $chef->delete();
        if (File::exists(public_path('uploads/chefs/' . $old_img))) {
            File::delete(public_path('uploads/chefs/' . $old_img));
        }

        return redirect()->route('chef.index')->with('success', 'Success');
    }
}
