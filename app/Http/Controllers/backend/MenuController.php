<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Models\Menu;
use App\Models\MenuTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of menu';
        $menus = MenuTranslation::with('parentMenu')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.menu.index', compact('menus', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create menu';
        $languages = config('translatable.locales');
        return view('backend.pages.menu.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuStoreRequest $request
     * @return RedirectResponse
     */
    public function store(MenuStoreRequest $request)
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
                $request->image->move(public_path('uploads/menus'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['menu_id'] = Menu::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'button_url' => $validated['button_url'][$i],
                    'button_title' => $validated["button_title"][$i],
                    'menu_id' => $validated['menu_id']
                ];
                array_push($translate_data, $datas);
            }

            MenuTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/menus/' . $data['image']))) {
                File::delete(public_path('uploads/menus/' . $data['image']));
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
        $page = 'Edit menu';
        $languages = config('translatable.locales');
        $menus = MenuTranslation::with('parentMenu')->where(['menu_id' => $id])->get();

        return view('backend.pages.menu.edit', compact('menus', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(MenuUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = MenuTranslation::find($id);
        $menu_id = $translation->menu_id;
        $menu = Menu::find($menu_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/menus'), $imageName);
                $data['image'] = $imageName;

                $old_img = $menu->image;
            }

            $menu->update($data);
            $translation->update($validated);

            if ($menu->wasChanged('image')) {
                if (File::exists(public_path('uploads/menus/' . $old_img))) {
                    File::delete(public_path('uploads/menus/' . $old_img));
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
    public function destroy(Menu $menu)
    {
        $old_img = $menu->image;
        $menu->delete();
        if (File::exists(public_path('uploads/menus/' . $old_img))) {
            File::delete(public_path('uploads/menus/' . $old_img));
        }

        return redirect()->route('menu.index')->with('success', 'Success');
    }
}
