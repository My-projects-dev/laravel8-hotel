<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\HotelInformation;
use App\Models\HotelInformationTranslation;
use App\Models\NearBy;
use App\Models\Team;
use App\Models\TeamTranslation;

class AboutController extends Controller
{
    public function index($language = 'en')
    {
        $abouts = About::with(['aboutTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }, 'aboutImage'
        ])->where('status', 1)->get();

        $teams = Team::with(['teamTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $informations = HotelInformation::with(['infoTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        $nearbies = NearBy::with(['nearTranslation' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.about.about', compact('nearbies', 'abouts', 'teams', 'informations'));
    }
}
