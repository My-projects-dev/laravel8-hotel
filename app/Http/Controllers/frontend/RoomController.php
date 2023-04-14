<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Facility;
use App\Models\NearBy;
use App\Models\Room;
use App\Models\RoomTranslation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class RoomController extends Controller
{
    public function index($language = 'en')
    {
        $rooms = Room::with([
            'roomTranslation' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'parentRoomType.roomTypeTranslation' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'roomImage' => function ($query) {
                $query->where('main', 1);
            }
        ])
            ->orderBy('price', 'DESC')
            ->paginate(10);

        $facilities = Facility::with(['facilityTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->orderBy('id', 'DESC')->limit(4)->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.rooms.room_category', compact('rooms', 'facilities', 'nearbies'));
    }

    public function search($language = 'en', Request $request)
    {
        if ($request->method() == 'GET') {
            return redirect()->route('front.rooms');
        }

        $checkinDate = (Carbon::createFromDate(strip_tags($request->start)))->format('Y-m-d');
        $checkoutDate = (Carbon::createFromDate(strip_tags($request->end)))->format('Y-m-d');
        $adults = $request->adult;
        $children = $request->child;
        $guests = $children + $adults;

        $rooms = Room::where('status', '1')
            ->where('adult', '>=', $adults)
            ->whereRaw('`child` + `adult` >= ?', [$guests])
            ->whereDoesntHave('reservations', function ($query) use ($checkinDate, $checkoutDate) {
                $query->where(function ($q) use ($checkinDate, $checkoutDate) {
                    $q->where('checkin_date', '<', $checkoutDate)
                        ->where('checkout_date', '>', $checkinDate);
                });
            })
            ->orderBy('price')
            ->paginate(10);


        $facilities = Facility::with(['facilityTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->orderBy('id', 'DESC')->limit(4)->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();



       return view('frontend.pages.rooms.room_category', compact('rooms', 'facilities', 'nearbies'));
    }


    public function show(string $language = 'en', $slug)
    {
        $room = RoomTranslation::with([
            'parentRoom' => function ($query) use ($language) {
                $query->with([
                    'parentRoomType.roomTypeTranslation' => function ($query) use ($language) {
                        $query->where('language', $language);
                    },
                    'roomAmenity.parentAmenity.roomAmenityTranslation' => function ($query) use ($language) {
                        $query->where('language', $language);
                    },
                    'roomImage'
                ]);
            }
        ])->where(['slug' => $slug])->first();

        $facilities = Facility::with(['facilityTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->orderBy('id', 'DESC')->limit(4)->get();

        $blogs = Blog::with(['blogTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.rooms.room_overview', compact('room', 'facilities', 'blogs', 'nearbies'));
    }
}
