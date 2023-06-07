<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return redirect()->route('reservation.index');
//        $page = 'Dashboard';
//        return view('backend.pages.dashboard.dashboard', compact( 'page'));
    }
}
