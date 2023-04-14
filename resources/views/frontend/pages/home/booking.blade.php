<!-- ======================== Booking ======================== -->

<section class="booking booking-inner">

    <div class="section-header hidden">
        <div class="container">
            <h2 class="title">Booking & reservations</h2>
        </div>
    </div>

    <div class="booking-wrapper">

        <div class="container">
            <div class="row">

                <form action="{{route('front.rooms.booking', app()->getLocale())}}" method="post">
                    @csrf
                    <!--=== date arrival ===-->

                    <div class="col-xs-4 col-sm-3">
                        <div class="date" id="dateArrival" data-text="Arrival">
                            <input class="datepicker" readonly="readonly" name="start"/>
                            <div class="date-value"></div>
                        </div>
                    </div>

                    <!--=== date departure ===-->

                    <div class="col-xs-4 col-sm-3">
                        <div class="date" id="dateDeparture" data-text="Departure">
                            <input class="datepicker" readonly="readonly" name="end"/>
                            <div class="date-value"></div>
                        </div>
                    </div>

                    <!--=== guests ===-->

                    <div class="col-xs-4 col-sm-2">

                        <div class="guests" data-text="Guests">
                            <div class="result">
                                <input class="qty-result" type="text" value="2" id="qty-result" readonly="readonly"/>
                                <div class="qty-result-text date-value" id="qty-result-text"></div>
                            </div>
                            <!--=== guests list ===-->
                            <ul class="guest-list">

                                <li class="header">
                                    Please choose number of guests <span class="qty-apply"><i
                                            class="icon icon-cross"></i></span>
                                </li>

                                <!--=== adults ===-->

                                <li class="clearfix">

                                    <!--=== Adults value ===-->

                                    <div>
                                        <input class="qty-amount" value="2" type="text" id="ticket-adult" data-value="2"
                                               readonly="readonly" name="adult"/>
                                    </div>

                                    <div>
                                        <span>Adults <small>16+ years</small></span>
                                    </div>

                                    <!--=== Add/remove quantity buttons ===-->

                                    <div>
                                        <input class="qty-btn qty-minus" value="-" type="button"
                                               data-field="ticket-adult"/>
                                        <input class="qty-btn qty-plus" value="+" type="button"
                                               data-field="ticket-adult"/>
                                    </div>

                                </li>

                                <!--=== chilrens ===-->

                                <li class="clearfix">

                                    <!--=== Adults value ===-->

                                    <div>
                                        <input class="qty-amount" value="0" type="text" id="ticket-children"
                                               data-value="0"
                                               readonly="readonly" name="child"/>
                                    </div>

                                    <!--=== Label ===-->

                                    <div>
                                        <span>Children <small>2-11 years</small></span>
                                    </div>


                                    <!--=== Add/remove quantity buttons ===-->

                                    <div>
                                        <input class="qty-btn qty-minus" value="-" type="button"
                                               data-field="ticket-children"/>
                                        <input class="qty-btn qty-plus" value="+" type="button"
                                               data-field="ticket-children"/>
                                    </div>

                                </li>

                                <!--=== Infants ===-->

                                <li class="clearfix">

                                    <!--=== Adults value ===-->

                                    <div>
                                        <input class="qty-amount" value="0" type="text" id="ticket-infants"
                                               data-value="0"
                                               readonly="readonly" name="infant"/>
                                    </div>

                                    <!--=== Label ===-->

                                    <div>
                                        <span>Infants <small>Under 2 years</small></span>
                                    </div>

                                    <!--=== Add/remove quantity buttons ===-->

                                    <div>
                                        <input class="qty-btn qty-minus" value="-" type="button"
                                               data-field="ticket-infants"/>
                                        <input class="qty-btn qty-plus" value="+" type="button"
                                               data-field="ticket-infants"/>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!--=== button ===-->

                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="btn btn-clean">
                            @lang('frontend.book')
                            <small> @lang('frontend.book subtitle')</small>
                        </button>
                    </div>
                </form>
            </div> <!--/row-->
        </div><!--/booking-wrapper-->
    </div> <!--/container-->
</section>
