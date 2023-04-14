@extends('layouts.frontend.master')
@section('content')
    <!-- ========================  Checkout ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
            <div class="container">
                <h2 class="title">Confirm your reservation</h2>
                <p>Guest information</p>
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
                            <li class="col-md-6 {{Cache::has('checkout') ? 'active' : ''}}">
                                <a href="{{route('front.checkout')}}"><span data-text="Checkout"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!-- ===  Checkout === -->

        @if ($message = Session::get('error'))
            <div class="alert alert-danger pb-0">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="checkout">

            <div class="container">

                <div class="clearfix">

                    <!-- ========================  Note block ======================== -->

                    <div class="cart-wrapper">

                        <div class="note-block">
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
                                            <div class="h2 title">₼ {{$reservation['total']}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================  Cart  ======================== -->

                        </div>
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="white-block">
                                    <div class="login-block login-block-signup">
                                        <form
                                            role="form"
                                            action="{{route('front.checkout.create', app()->getLocale())}}"
                                            method="post"
                                            class="require-validation"
                                            data-cc-on-file="false"
                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                            id="payment-form">
                                            @csrf

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="adult"
                                                           value="{{$reservation['adults']}}">
                                                    <input type="hidden" class="form-control" name="child"
                                                           value="{{$reservation['children']}}">
                                                    <input type="hidden" class="form-control" name="infant"
                                                           value="{{$reservation['infants']}}">
                                                    <input type="hidden" class="form-control" name="checkin_date"
                                                           value="{{$reservation['checkinDate']}}">
                                                    <input type="hidden" class="form-control" name="checkout_date"
                                                           value="{{$reservation['checkoutDate']}}">
                                                    <input type="hidden" class="form-control" name="room_id"
                                                           value="{{$reservation['room']->parentRoom->id}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group required">
                                                <input type="text" class="form-control" required
                                                       placeholder="First name: *" name="name">
                                                @error('name')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 form-group required">
                                                <input type="text" class="form-control" required
                                                       placeholder="Last name: *" name="surname">
                                                @error('surname')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <input type="text" value="" class="form-control"
                                                       placeholder="Company name:" name="company_name">
                                                @error('company_name')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 form-group required">
                                                <input type="text" value="" class="form-control" required
                                                       placeholder="Country:" name="country">
                                                @error('country')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 form-group required">
                                                <input type="text" value="" class="form-control" required
                                                       placeholder="Zip code: *" name="zip">
                                                @error('zip')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-8 form-group required">
                                                <input type="text" value="" class="form-control" required
                                                       placeholder="City: *" name="city">
                                                @error('city')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 form-group required">
                                                <input type="email" value="" class="form-control" required
                                                       placeholder="Email: *" name="email">
                                                @error('email')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 form-group required">
                                                <input type="tel" value="" class="form-control" required
                                                       placeholder="Phone: *" name="phone">
                                                @error('phone')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class='col-xs-12 form-group required'>
                                                <input class='form-control' size='4' type='text'
                                                       placeholder="Name on Card" name="card_name">
                                                @error('card_name')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class='col-xs-12 form-group card required'>
                                                <input autocomplete='off' class='form-control card-number' size='17'
                                                       type='number' placeholder="Card Number" name="card_number">
                                                @error('card_number')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <input autocomplete='off' class='form-control card-cvc'
                                                       placeholder='CVV' size='4' type='number' name="cvv" min="0">
                                                @error('cvv')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                                    type='number' name="expiration_month" min="01" max="12">
                                                @error('expiration_month')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <input class='form-control card-expiry-year' placeholder='YYYY'
                                                    size='4' type='number' name="expiration_year" min="{{ now()->year }}">
                                                @error('expiration_year')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div> <!--/col-md-6-->
                            </div>
                        </div>

                    </div> <!--/container-->

                </div> <!--/checkout-->
            </div>
        </div>
    </section>


    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function () {

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

@endsection
