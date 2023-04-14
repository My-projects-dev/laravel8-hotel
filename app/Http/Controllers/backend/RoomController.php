<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Amenity;
use App\Models\AmenityTranslation;
use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\RoomImage;
use App\Models\RoomTranslation;
use App\Models\RoomType;
use App\Models\RoomTypeTranslation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $page = 'List of rooms';

        $rooms = Room::with([
            'roomTranslation' => function ($query) {
                $query->where('language', 'az');
            },
            'parentRoomType.roomTypeTranslation' => function ($query) {
                $query->where('language', 'az')->pluck('title');
            },
            'roomImage' => function ($query) {
                $query->where('main', 1);
            }
        ])
            ->orderBy('id', 'DESC')
            ->paginate(10);


        return view('backend.pages.room.index', compact('rooms', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $page = 'Create room';
        $languages = config('translatable.locales');

        $amenities = AmenityTranslation::with(['parentAmenity'=>function ($query){
            $query->where('status', '1');
        }])->where(['language' => 'az'])->get();

        $room_types = RoomTypeTranslation::with(['parentRoomType'=>function ($query){
            $query->where('status', '1');
        }])->where(['language' => 'az'])->get();

        return view('backend.pages.room.create', compact('page', 'amenities', 'room_types', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RoomStoreRequest $request)
    {


        $validated = $request->validated();
        $slug = [];
        $images = [];
        $amenity = [];
        $translate_data = [];
        $lang = config('translatable.locales');


        for ($i = 0; $i < count($lang); $i++) {
            $slug[] = $validated['slug'][$i];
        }

        if (count(array_unique($slug)) != count($lang)) {
            return redirect()->back()->with('error', "slug values cannot be identical");
        }

        $room = new Room();
        $room->adult = $validated['adult'];
        $room->child = $validated['child'];
        $room->price = $validated['price'];
        $room->status = $validated['status'];
        $room->room_type_id = $validated['type'];
        $room->number_of_rooms = $validated['number_of_rooms'];

        try {
            DB::beginTransaction();

            $room->save();
            $room_id = $room->id;

            if ($request->hasFile('main_image')) {
                $imageName = rand(1, 1000) . time() .'.'. $request->main_image->getClientOriginalExtension();
                $request->main_image->move(public_path('uploads/rooms'), $imageName);
                $img = [
                    'room_id' => $room_id,
                    'image' => $imageName,
                    'main' => 1
                ];
                array_push($images, $img);
            }

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 1000) . '.' . $file->extension();
                    $file->move(public_path('uploads/rooms'), $name);
                    $img = [
                        'room_id' => $room_id,
                        'image' => $name,
                        'main' => '0'
                    ];
                    array_push($images, $img);
                }
            }

            RoomImage::insert($images);

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'slug' => $validated['slug'][$i],
                    'title' => $validated['title'][$i],
                    'overview' => $validated['overview'][$i],
                    'rules' => $validated['rules'][$i],
                    'room_id' => $room_id,
                ];
                array_push($translate_data, $datas);
            }

            RoomTranslation::insert($translate_data);

            if (array_key_exists('amenity', $validated)) {
                $amenity_id = $validated['amenity'];
                for ($i = 0; $i < count($amenity_id); $i++) {
                    $rm = [
                        'room_id' => $room_id,
                        'amenity_id' => $amenity_id[$i],
                    ];
                    $amenity[] = $rm;
                }
                RoomAmenity::insert($amenity);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (array_key_exists('image', $images)) {
                for ($i = 0; $i <= count($images['image']); $i++) {
                    if (File::exists(public_path('uploads/rooms/' . $images['image'][$i]))) {
                        File::delete(public_path('uploads/rooms/' . $images['image'][$i]));
                    }
                }
            }
            return redirect()->back()->with('error', "Failed operation");
        }
        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Room $slider
     * @return void
     */
    public function show(Room $slider)
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
        $page = 'Edit room';
        $languages = config('translatable.locales');
        $images = RoomImage::where('room_id', $id)->get();
        $rooms = RoomTranslation::with('parentRoom')->where(['room_id' => $id])->get();
        $room_amenity = RoomAmenity::where(['room_id' => $id])->pluck('amenity_id')->toArray();

        $amenities = AmenityTranslation::with(['parentAmenity'=>function ($query){
            $query->where('status', '1');
        }])->where(['language' => 'az'])->get();

        $room_types = RoomTypeTranslation::with(['parentRoomType'=>function ($query){
            $query->where('status', '1');
        }])->where(['language' => 'az'])->get();

        return view('backend.pages.room.edit', compact('rooms', 'page', 'room_amenity', 'amenities', 'room_types', 'images','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoomUpdateRequest $request, int $id)
    {
        $translation = RoomTranslation::find($id);
        $room_id = $translation->room_id;
        $room = Room::find($room_id);
        $validated = $request->validated();
        $amenity = [];
        $images = [];
        $datas = [];
        $data = [];

        $data['adult'] = $validated['adult'];
        $data['child'] = $validated['child'];
        $data['price'] = $validated['price'];
        $data['status'] = $validated['status'];
        $data['room_type_id'] = $validated['type'];
        $data['number_of_rooms']  = $validated['number_of_rooms'];

        $datas['slug'] = $validated['slug'];
        $datas['title'] = $validated['title'];
        $datas['overview'] = $validated['overview'];
        $datas['rules'] = $validated['rules'];

        try {
            DB::beginTransaction();

            $room->update($data);
            $translation->update($datas);
            $image = new RoomImage;

            if (array_key_exists('amenity', $validated)) {
                $amenity_id = $validated['amenity'];
                for ($i = 0; $i < count($amenity_id); $i++) {
                    $rm = [
                        'room_id' => $room_id,
                        'amenity_id' => $amenity_id[$i],
                    ];
                    $amenity[] = $rm;
                }
                RoomAmenity::where('room_id', $room_id)->delete();
                RoomAmenity::insert($amenity);
            }


            $main = $image->where(['room_id' => $room_id])->where('id', $validated['main'])->update(['main' => '1']);
            if ($main) {
                $image->where(['room_id' => $room_id])->where('id', '!=', $validated['main'])->update(['main' => '0']);
            }

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 1000) . '.' . $file->extension();
                    $file->move(public_path('uploads/rooms'), $name);
                    $img = [
                        'room_id' => $room_id,
                        'image' => $name,
                        'main' => '0'
                    ];
                    $images[] = $img;
                }
                $image::insert($images);
            }

            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $key => $file) {
                    $name = time() . rand(1, 1000) . '.' . $file->extension();
                    $file->move(public_path('uploads/rooms'), $name);
                    $img = ['image' => $name];
                    $img_id = $validated["id"][$key];

                    $old_img = $image->where(['room_id' => $room_id, 'id' => $img_id])->value('image');
                    $upd = $image->where(['room_id' => $room_id, 'id' => $img_id])->update($img);

                    if ($upd and File::exists(public_path('uploads/rooms/' . $old_img))) {
                        File::delete(public_path('uploads/rooms/' . $old_img));
                    }
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "$e");
        }

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @return RedirectResponse
     */
    public function destroy(Room $room)
    {
        try {
            $old_images = RoomImage::where('room_id', $room->id)->pluck('image');
            $img_delete = RoomImage::where('room_id', $room->id)->delete();
            RoomAmenity::where('room_id', $room->id)->delete();
            $room->delete();

            if ($img_delete) {
                foreach ($old_images as $old_img) {
                    if (File::exists(public_path('uploads/rooms/' . $old_img))) {
                        File::delete(public_path('uploads/rooms/' . $old_img));
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Failed operation");
        }

        return redirect()->route('room.index')->with('success', 'Success');
    }
}
