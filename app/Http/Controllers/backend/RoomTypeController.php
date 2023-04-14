<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeStoreRequest;
use App\Http\Requests\RoomTypeUpdateRequest;
use App\Models\RoomType;
use App\Models\RoomTypeTranslation;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of room types';
        $types = RoomTypeTranslation::with('parentRoomType')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);

        return view('backend.pages.room_type.index', compact('types', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Create room types';
        $languages = config('translatable.locales');
        return view('backend.pages.room_type.create', compact('page','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeStoreRequest $request)
    {
        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['status'] = $validated['status'];
        $lang = config('translatable.locales');

        try {
            DB::beginTransaction();

            $validated['room_type_id'] = RoomType::create($data)->id;

            for ($i=0; $i<count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'title' => $validated['title'][$i],
                    'room_type_id' => $validated['room_type_id']
                ];
                $translate_data[] = $datas;
            }

            RoomTypeTranslation::insert($translate_data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $page = 'Edit room types';
        $languages = config('translatable.locales');
        $room_types = RoomTypeTranslation::with('parentRoomType')->where(['room_type_id'=>$id])->get();
        return view('backend.pages.room_type.edit', compact('room_types', 'page','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomTypeUpdateRequest $request, int $id)
    {
        $translation = RoomTypeTranslation::find($id);
        $room_type_id = $translation->room_type_id;
        $room_type = RoomType::find($room_type_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();

            $room_type->update($data);
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
     * @param RoomType $roomtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomtype)
    {
        $delete = $roomtype->delete();

        if ($delete) {
            return redirect()->route('roomtype.index')->with('success', 'Success');
        }
        return redirect()->route('roomtype.index')->with('error', 'The deletion failed');
    }
}
