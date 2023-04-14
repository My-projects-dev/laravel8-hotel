@extends('layouts.frontend.master')
@section('content')
    <!-- ========================  Checkout ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">

            <div class="container">
                <h2 class="title">Reservation completed</h2>
                <p>Thank you!</p>
            </div>

        </div>

        <!-- ===  Step wrapper === -->

            <div class="step-wrapper">
                <div class="container">

                    <div class="stepper">
                        <ul class="row">
                            <li class="col-md-6 active">
                                <a href="{{route('front.reservation')}}"><span data-text="Reservation"></span></a>
                            </li>
                            <li class="col-md-6 active">
                                <a href="{{route('front.checkout')}}"><span data-text="Checkout"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        <!-- ===  Checkout === -->

        <div class="checkout">

            <div class="container">

                <div class="clearfix">

                    <!-- ========================  Note block ======================== -->

                    <div class="cart-wrapper">

                        <div class="note-block">

                            <div class="row">
                                <!-- === left content === -->

                                <div class="col-md-6">

                                    <div class="white-block">

                                        <div class="h4">Guest information</div>

                                        <hr/>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Name</strong> <br/>
                                                    <span>{{$checkout->name.' '.$checkout->surname}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Email</strong><br/>
                                                    <span>{{$checkout->email}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Phone</strong><br/>
                                                    <span>{{$checkout->phone}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Zip</strong><br/>
                                                    <span>{{$checkout->zip}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>City</strong><br/>
                                                    <span>{{$checkout->city}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Company name</strong><br/>
                                                    <span>{{$checkout->company_name ?? ''}}</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div> <!--/col-md-6-->

                                </div>

                                <!-- === right content === -->

                                <div class="col-md-6">
                                    <div class="white-block">

                                        <div class="h4">Reservation details</div>

                                        <hr/>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Order no.</strong> <br/>
                                                    <span>{{$checkout->id}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Transaction ID</strong> <br/>
                                                    <span>{{$checkout['transaction']}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Order date</strong> <br/>
                                                    <span>{{$checkout->created_at->format('d/m/Y')}}</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="h4">Payment details</div>

                                        <hr/>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Transaction time</strong> <br/>
                                                    <span>{{str_replace('-', '/', $checkout->created_at)}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Amount</strong><br/>
                                                    <span>{{'₼ '.$checkout['amount']}}</span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Cart details</strong><br/>
                                                    <span>**** **** **** {{$checkout['last4']}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Reservation type</strong><br/>
                                                    <span>{{$reservation['room']->parentRoom->parentRoomType->roomTypeTranslation->first()->title}}</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================  Cart wrapper ======================== -->

                    <div class="cart-wrapper">

                        <!--cart header -->

                        <div class="cart-block cart-block-header clearfix">
                            <div>
                                <span>Room type</span>
                            </div>
                            <div class="text-right">
                                <span>Price</span>
                            </div>
                        </div>

                        <!--cart items-->

                        <div class="clearfix">

                            <div class="cart-block cart-block-item clearfix">
                                <div class="image">
                                    <img
                                        src="{{asset('uploads/rooms/'.$reservation['room']->parentRoom->roomImage->first()->image)}}"
                                        alt=""/>
                                </div>
                                <div class="title">
                                    <div
                                        class="h2">{{$reservation['room']->parentRoom->parentRoomType->roomTypeTranslation->first()->title}}</div>
                                    <p>
                                        <strong>Arrival date</strong> <br/> <a href="#">({{$reservation['start']}})</a>
                                    </p>
                                    <p>
                                        <strong>Guests</strong>
                                        <br/> {{($reservation['adults']>1) ? $reservation['adults'].' Adults': $reservation['adults'].' Adult'}}
                                        {{($reservation['children']!=0) ? ', '.(($reservation['children']>1) ? $reservation['children'].' Children' : $reservation['children'].' Child') : ''}}
                                        {{($reservation['infants']!=0) ? ', '.(($reservation['infants']>1) ? $reservation['infants'].' Infants' : $reservation['infants'].' Infant') : ''}}
                                    </p>
                                    <p>
                                        <strong>Nights</strong> <br/> {{$reservation['nights']}}
                                    </p>
                                </div>
                                <div class="price">
                                    <span class="final h3">₼ {{$reservation['new_price']}}</span>
                                    <span
                                        class="discount">₼ {{($reservation['discount']!=0) ? $reservation['room']->parentRoom->price : ''}}</span>
                                </div>
                                <!--delete-this-item-->
                                <span class="icon icon-cross icon-delete"></span>
                            </div>

                        </div>

                        <!--cart prices -->

                        <div class="clearfix">
                            <div class="cart-block cart-block-footer clearfix">
                                <div>
                                    <strong>Discount {{$reservation['discountt'].'%'}}</strong>
                                </div>
                                <div>
                                    <span>₼ {{$reservation['discount']}}</span>
                                </div>
                            </div>

                            <div class="cart-block cart-block-footer clearfix">
                                <div>
                                    <strong>TAX</strong>
                                </div>
                                <div>
                                    <span>₼ {{$reservation['tax']}}</span>
                                </div>
                            </div>
                        </div>

                        <!--cart final price -->

                        <div class="clearfix">
                            <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                                <div>
                                    <strong class="h2">Total</strong>
                                </div>
                                <div>
                                    <div class="h2 title">{{'₼ '.$checkout['amount']}}</div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================  Cart navigation ======================== -->

                        <div class="clearfix">
                            <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                                <div>
                                    <a href="{{route('front.reservation')}}" class="btn btn-clean-dark">Back</a>
                                </div>
                                <div>
                                    <a onclick="window.print()" class="btn btn-main">Print <span
                                            class="icon icon-printer"></span></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div> <!--/container-->
        </div> <!--/checkout-->

    </section>
@endsection

