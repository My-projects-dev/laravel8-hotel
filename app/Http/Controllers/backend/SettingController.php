<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\SettingTranslation;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of setting';
        $settings = SettingTranslation::with('parentSetting')->where('language', 'en')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.setting.index', compact('settings', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create setting';
        $languages = config('translatable.locales');
        return view('backend.pages.setting.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SettingStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SettingStoreRequest $request)
    {
        $lang = config('translatable.locales');

        $validated = $request->validated();
        $data = [];
        $data['image'] = '';
        $translate_data = [];
        $data['status'] = $validated['status'];
        $data['key'] = $validated['key'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/settings'), $imageName);
                $data['image'] = $imageName;
            }
            $setting_id = Setting::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'value' => $validated["value"][$i],
                    'setting_id' => $setting_id
                ];
                array_push($translate_data, $datas);
            }

            SettingTranslation::insert($translate_data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/settings/' . $data['image']))) {
                File::delete(public_path('uploads/settings/' . $data['image']));
            }

            return redirect()->back()->with('error', "Failed operation");
        }

        if (Cache::has('settings')) {
            Cache::forget('settings');
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
        $page = 'Edit setting';
        $languages = config('translatable.locales');
        $settings = SettingTranslation::with('parentSetting')->where(['setting_id' => $id])->get();

        return view('backend.pages.setting.edit', compact('settings', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(SettingUpdateRequest $request, int $id)
    {
        $translation = SettingTranslation::find($id);
        $setting_id = $translation->setting_id;
        $setting = Setting::find($setting_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];
        $data['key'] = $validated['key'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/settings'), $imageName);
                $data['image'] = $imageName;

                $old_img = $setting->image;
            }

            $setting->update($data);
            $translation->update($validated);

            if ($setting->wasChanged('image')) {
                if (File::exists(public_path('uploads/settings/' . $old_img))) {
                    File::delete(public_path('uploads/settings/' . $old_img));
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Failed operation");
        }

        if (Cache::has('settings')) {
            Cache::forget('settings');
        }

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Setting $setting)
    {
        $old_img = $setting->image;
        $setting->delete();
        if (File::exists(public_path('uploads/settings/' . $old_img))) {
            File::delete(public_path('uploads/settings/' . $old_img));
        }

        if (Cache::has('settings')) {
            Cache::forget('settings');
        }

        return redirect()->route('setting.index')->with('success', 'Success');
    }
}
