<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomAdditionalPrice;
use App\Models\RoomTranslation;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Stripe\Charge;
use Stripe\Stripe;

class BookingController extends Controller
{
    public function reservationCreate($language = 'en', Request $request)
    {
        $additional = new RoomAdditionalPrice();
        $slug = $request->slug;
        $start = strip_tags($request->start);
        $end = strip_tags($request->end);
        $start = Carbon::createFromDate($start);
        $end = Carbon::createFromDate($end);
        $nights = $start->diff($end)->days;

        $checkinDate = $start->format('Y-m-d');
        $checkoutDate = $end->format('Y-m-d');
        $start = $start->format('M d Y');
        $adults = $request->adult;
        $children = $request->child;
        $infants = $request->infant;
        $discountt = $additional::where('title', 'discount')->value('price');
        $tax = $additional::where('title', 'tax')->value('price');

        $room = RoomTranslation::with([
            'parentRoom' => function ($query) use ($language) {
                $query->with([
                    'parentRoomType.roomTypeTranslation' => function ($query) use ($language) {
                        $query->where('language', $language);
                    },
                    'roomAmenity.parentAmenity.roomAmenityTranslation' => function ($query) use ($language) {
                        $query->where('language', $language);
                    },
                    'roomImage' => function ($query) {
                        $query->where('main', 1);
                    },
                ]);
            }
        ])->where(['slug' => $slug])->first();

        $check = $this->checkAvailability($room->room_id, $checkinDate, $checkoutDate);

        if ($check == false) {
            return redirect()->back()->with('error', 'There are no available rooms on these dates. Choose another date or room..');
        }

        $adult = $room->parentRoom->adult;
        $guest = $adult + $room->parentRoom->child;
        $guests = $adults + $children;

        if ($adults <= 0 || $adult < $adults || $guest < $guests) {
            return redirect()->back();
        }

        $new_price = $room->parentRoom->price;

        if ($discountt != 0) {
            $discount = $room->parentRoom->price * ($discountt / 100);
            $new_price = $new_price - $discount;
        }

        if ($tax != 0) {
            $tax = $new_price * ($tax / 100);
        }

        $total = $new_price + $tax;

        $data = [];
        $data['checkinDate'] = $checkinDate;
        $data['checkoutDate'] = $checkoutDate;
        $data['total'] = $total;
        $data['new_price'] = $new_price;
        $data['nights'] = $nights;
        $data['adults'] = $adult;
        $data['children'] = $children;
        $data['infants'] = $infants;
        $data['room'] = $room;
        $data['start'] = $start;
        $data['discount'] = $discount;
        $data['discountt'] = $discountt;
        $data['tax'] = $tax;

       session(['reservation' => $data]);

        return redirect()->route('front.reservation');
    }


    public function reservation($language = 'en')
    {
        if (session()->has('reservation')) {
            $reservation = session('reservation');
        } else {
            return redirect()->back();
        }
        return view('frontend.pages.reservation.reservation', compact('reservation'));
    }


    public function checkoutCreate($language = 'en', ReservationRequest $request)
    {
        $additional = new RoomAdditionalPrice();
        $validated = $request->validated();

        $room = Room::find($validated['room_id']);

        if ($room == null) {
            return redirect()->route('front.rooms')->with('error', 'No such room exists');
        }

        $new_price = $room->price;
        $discount = $additional::where('title', 'discount')->value('price');
        $tax = $additional::where('title', 'tax')->value('price');

        if ($discount != 0) {
            $discount = $room->price * ($discount / 100);
            $new_price = $room->price - $discount;
        }

        if ($tax != 0) {
            $tax = $new_price * ($tax / 100);
        }

        $total = floor($new_price + $tax);
        $validated['price'] = $total;

        $check = $this->checkAvailability($room->id, $validated['checkin_date'], $validated['checkout_date']);

        if ($check == false) {
            return redirect()->route('front.rooms')->with('error', 'There are no available rooms on these dates. Choose another date or room..');
        }


        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::create([
                'amount' => $total,
                'currency' => "azn",
                'source' => $request->stripeToken,
                'description' => 'room'
            ]);

            $reservation = Reservation::create($validated);

        } catch (Exception $e) {
            return redirect()->back()->with('error', "$e");
        }

        $reservation['amount'] = $charge->amount;
        $reservation['transaction'] = $charge->id;
        $reservation['last4'] = $charge->payment_method_details->card->last4;

        session(['checkout' => $reservation]);
        return redirect()->route('front.checkout');
    }


    public function checkout($language = 'en')
    {
        if (session()->has('reservation') and session()->has('checkout')) {
            $reservation = session('reservation');
            $checkout = session('checkout');
        } else {
            return redirect()->back();
        }

        return view('frontend.pages.reservation.checkout', compact('checkout','reservation'));
    }


    public function checkAvailability($room_id, $checkinDate, $checkoutDate)
    {
        $room = Room::find($room_id);

        $reservations = Reservation::where('room_id', $room_id)
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->where('checkin_date', '>=', $checkinDate)
                    ->where('checkin_date', '<', $checkoutDate)
                    ->orWhere('checkout_date', '>', $checkinDate)
                    ->where('checkout_date', '<=', $checkoutDate);
            })
            ->count();

        if ($reservations <= $room->number_of_rooms) {
            return true;
        } else {
            return false;
        }
    }
}
