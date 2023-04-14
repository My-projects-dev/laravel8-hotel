@extends('layouts.backend.master')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a href="{{route('reservation.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of reservations
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-4">
                                    <span class="text-primary">Name:</span> {{$reservation->name}} <br>
                                    <span class="text-primary">Surname:</span> {{$reservation->surname}} <br>
                                    <span class="text-primary">Adults:</span> {{$reservation->adult}} <br>
                                    <span class="text-primary">Children:</span> {{$reservation->child}} <br>
                                    <span class="text-primary">Infants:</span> {{$reservation->infant}} <br>
                                    <span class="text-primary">Email:</span> {{$reservation->email}} <br>
                                    <span class="text-primary">Phone:</span> {{$reservation->phone}} <br>
                                    <span class="text-primary">Company Name:</span> {{$reservation->company_name ?? ''}} <br>
                                    <span class="text-primary">Country:</span> {{$reservation->country}} <br>
                                    <span class="text-primary">City:</span> {{$reservation->city}} <br>
                                    <span class="text-primary">Zip code:</span> {{$reservation->zip}} <br>
                                    <span class="text-primary">Check in date:</span> {{$reservation->checkin_date}} <br>
                                    <span class="text-primary">Check out date:</span> {{$reservation->checkout_date}} <br>
                                    <span class="text-primary">Price:</span> {{$reservation->price.' ₼'}} <br>
                                    <span class="text-primary">Room type:</span> {{$reservation->parentRoom->parentRoomType->roomTypeTranslation->first()->title}} <br>
                                    <span class="text-primary">Room title:</span> {{$reservation->parentRoom->roomTranslation->first()->title}} <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
