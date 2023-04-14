<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Facility;
use App\Models\FacilityTranslation;
use App\Models\NearBy;
use App\Models\NearByTranslation;
use App\Models\Room;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\Testimonial;
use App\Models\TestimonialTranslation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($language = 'en')
    {
        $sliders = Slider::with(['sliderTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $facilities = Facility::with(['facilityTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->orderBy('id', 'DESC')->limit(4)->get();

        $blogs = Blog::with(['blogTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $testimonials = Testimonial::with(['testimonialTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();


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
        ])->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(12)
            ->get();

        $apartment = Room::with([
            'roomTranslation' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'parentRoomType.roomTypeTranslation' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'roomImage' => function ($query) {
                $query->where('main', 1);
            },
            'roomAmenity.parentAmenity.roomAmenityTranslation' => function ($query) use ($language) {
                $query->where('language', $language);
            },
        ])->where('status', 1)
            ->orderBy('price', 'DESC')
            ->limit(2)
            ->get();

        return view('frontend.pages.home.home', compact('sliders', 'rooms', 'facilities', 'blogs', 'nearbies', 'apartment', 'testimonials'));
    }
}
