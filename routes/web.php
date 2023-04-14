<?php

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\AboutImageController;
use App\Http\Controllers\backend\AdditionController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AmenityController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\ChefController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\FacilityController;
use App\Http\Controllers\backend\FacilitySliderController;
use App\Http\Controllers\backend\HotelInfoController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\NearByController;
use App\Http\Controllers\backend\ReservationController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\RoomImageController;
use App\Http\Controllers\backend\RoomTypeController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\TestimonialController;



use App\Http\Controllers\frontend\AboutController as AboutFront;
use App\Http\Controllers\frontend\BlogController as BlogFront;
use App\Http\Controllers\frontend\BookingController as BookingFront;
use App\Http\Controllers\frontend\ContactController as ContactFront;
use App\Http\Controllers\frontend\FacilityController as FacilityFront;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\RoomController as RoomFront;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('about', AboutController::class);
    Route::delete('about/image/{id}', [AboutImageController::class, 'destroy'])->name('about.image.destroy');
    Route::resource('addition', AdditionController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('amenity', AmenityController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('chef', ChefController::class);
    Route::resource('comment', CommentController::class);
    Route::resource('facility', FacilityController::class);
    Route::resource('facility_slider', FacilitySliderController::class);
    Route::resource('info', HotelInfoController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('near', NearByController::class);
    Route::resource('room', RoomController::class);
    Route::resource('reservation', ReservationController::class);
    Route::delete('image/{id}', [RoomImageController::class, 'destroy'])->name('image.destroy');
    Route::resource('roomtype', RoomTypeController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('team', TeamController::class);
    Route::resource('testimonial', TestimonialController::class);


    Route::get('check_slug', function () {
        $slug = SlugService::createSlug(App\Models\RoomTranslation::class, 'slug', request('title'));
        return response()->json(['slug' => $slug]);
    });
    Route::get('blog_slug', function () {
        $slug = SlugService::createSlug(App\Models\BlogTranslation::class, 'slug', request('title'));
        return response()->json(['slug' => $slug]);
    });
});

// ---------------------------------------------------------------------------------------------------------------------------
//              FRONT
// ---------------------------------------------------------------------------------------------------------------------------
Route::group(['prefix' => '{language?}', 'middleware' => 'language'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('reservation/create', [BookingFront::class, 'reservationCreate'])->name('front.reservation.create');
    Route::get('reservation', [BookingFront::class, 'reservation'])->name('front.reservation');
    Route::get('checkout', [BookingFront::class, 'checkout'])->name('front.checkout');
    Route::post('checkout/create', [BookingFront::class, 'checkoutCreate'])->name('front.checkout.create');
    Route::get('blogs', [BlogFront::class, 'index'])->name('front.blogs');
    Route::get('blog/{slug?}', [BlogFront::class, 'show'])->name('front.blog');
    Route::get('about', [AboutFront::class, 'index'])->name('front.about');
    Route::get('contact', [ContactFront::class, 'index'])->name('front.contact');
    Route::get('facility', [FacilityFront::class, 'index'])->name('front.facility');
    Route::get('rooms', [RoomFront::class, 'index'])->name('front.rooms');
    Route::match(['get', 'post'],'rooms/booking', [RoomFront::class, 'search'])->name('front.rooms.booking');
    Route::get('room/{slug?}', [RoomFront::class, 'show'])->name('front.room');
});


require __DIR__ . '/auth.php';
