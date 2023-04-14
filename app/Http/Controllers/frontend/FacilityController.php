<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Chef;
use App\Models\Facility;
use App\Models\FacilitySlider;
use App\Models\Menu;
use App\Models\NearBy;

class FacilityController extends Controller
{
    public function index($language = 'en')
    {
        $sliders = FacilitySlider::where('status', 1)->orderBy('id', 'DESC')->get();

        $menus = Menu::with(['menuTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $chefs = Chef::with(['chefTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $facilities = Facility::with(['facilityTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->orderBy('id', 'DESC')->limit(4)->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.facility.facility', compact('sliders', 'facilities', 'nearbies', 'chefs', 'menus'));
    }
}
