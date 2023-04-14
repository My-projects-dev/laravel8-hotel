@extends('layouts.frontend.master')
@section('content')
    <!-- ========================  Facility ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
            <div class="container text-center">
                <h2 class="title">@lang('frontend.restaurant')</h2>
                <p>@lang('frontend.restaurant subtitle')</p>
            </div>
        </div>

        <div class="facility">

            <div class="container">
                <div class="facility-gallery">
                    <div class="owl-slider owl-theme owl-slider-gallery">
                        @foreach($sliders as $slider)
                            <!-- === slide item === -->

                            <div class="item" style="background-image:url({{asset('uploads/facility_slider/'.$slider->image)}})">
                                <img src="{{asset('uploads/facility_slider/'.$slider->image)}}" alt=""/>
                            </div>
                        @endforeach
                    </div> <!--/owl-slider-->

                </div> <!--/facilty-gallery-->

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                        <!-- === facility-info === -->

                        <div class="facility-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>@lang('frontend.restaurants')</h2>
                                    <p>
                                        {!! settings('restuarants') ?? '' !!}
                                    </p>
                                    <!--<p>
                                Enjoy the world’s finest wines, champagnes, caviar and other indulgences while
                                overlooking Fifth Avenue and the famous Pulitzer Fountain.
                            </p>-->
                                </div>
                                <div class="col-md-6">
                                    <h2>@lang('frontend.dining')</h2>
                                    <p>
                                        {!! settings('in-room') ?? '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- === facility-addons === -->

                        <div class="facility-addons">

                            <!-- === nav-tabs === -->

                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#menus" aria-controls="menus" role="tab" data-toggle="tab">
                                        <i class="hotelicon hotelicon-kitchen"></i>
                                        <span class="visible-md visible-lg">@lang('frontend.menus')</span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#chefs" aria-controls="chefs" role="tab" data-toggle="tab">
                                        <i class="hotelicon hotelicon-guestbook"></i>
                                        <span class="visible-md visible-lg">@lang('frontend.chef')</span>
                                    </a>
                                </li>
                                {{--                                <li role="presentation">--}}
                                {{--                                    <a href="#events" aria-controls="events" role="tab" data-toggle="tab">--}}
                                {{--                                        <i class="hotelicon hotelicon-clock"></i>--}}
                                {{--                                        <span class="visible-md visible-lg">Events</span>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                            </ul>

                            <!-- === tab-panes === -->

                            <div class="tab-content">

                                <!-- ============ tab #1 ============ -->

                                <div role="tabpanel" class="tab-pane active" id="menus">
                                    <div class="content">

                                        <div class="cards">

                                            <div class="row">
                                                @foreach($menus as $menu)
                                                    <!-- === item === -->

                                                    <div class="col-xs-{{$loop->first ? 12 : 6}} col-md-6">
                                                        <figure>
                                                            <figcaption
                                                                style="background-image:url({{asset('uploads/menus/'.$menu->image)}})">
                                                                <img src="{{asset('uploads/menus/'.$menu->image)}}"
                                                                     alt="{{asset('uploads/menus/'.$menu->menuTranslation->first()->button_title)}}"/>
                                                            </figcaption>
                                                            <a href="{{$menu->menuTranslation->first()->button_url}}"
                                                               class="btn btn-clean"
                                                               onclick="">{{$menu->menuTranslation->first()->button_title}}</a>
                                                        </figure>
                                                    </div>
                                                @endforeach


                                            </div> <!--/row-->

                                        </div> <!--/cards-->

                                    </div>
                                </div>

                                <!-- ============ tab #2 ============ -->

                                <div role="tabpanel" class="tab-pane" id="chefs">
                                    <div class="content">

                                        <div class="image-blocks image-blocks-category">

                                            @foreach($chefs as $key=>$chef)
                                                <!--=== item block === -->

                                                <div
                                                    class="blocks{{ $key % 2 == 0 ? ' blocks-left' : ' blocks-right' }}">
                                                    <div class="item">
                                                        <div class="text">
                                                            <h2 class="title">{{$chef->chefTranslation->first()->full_name}}
                                                                <small>{{$chef->chefTranslation->first()->position}}</small>
                                                            </h2>
                                                            {!! $chef->chefTranslation->first()->about !!}
                                                        </div>
                                                    </div>
                                                    <div class="image"
                                                         style="background-image:url({{asset('uploads/chefs/'.$chef->image)}})">
                                                        <img src="{{asset('uploads/chefs/'.$chef->image)}}"
                                                             alt="{{$chef->chefTranslation->first()->full_name}}"/>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div> <!--/image-blocks-->
                                    </div> <!--/content-->
                                </div>

                                <!-- ============ tab #3 ============ -->

                                {{--                                <div role="tabpanel" class="tab-pane" id="events">--}}
                                {{--                                    <div class="content">--}}

                                {{--                                        <div class="image-blocks image-blocks-category">--}}

                                {{--                                            <!--=== item block === -->--}}

                                {{--                                            <div class="blocks blocks-left">--}}
                                {{--                                                <div class="item">--}}
                                {{--                                                    <div class="text">--}}

                                {{--                                                        <!--=== events ===-->--}}

                                {{--                                                        <div class="events">--}}

                                {{--                                                            <!--=== event item ===-->--}}

                                {{--                                                            <a href="#">--}}
                                {{--                                                                <div class="event">--}}
                                {{--                                                                    <div class="date">--}}
                                {{--                                                                        <div class="date-card">--}}
                                {{--                                                                            <span>Sep</span>--}}
                                {{--                                                                            <strong>28</strong>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <div class="caption">--}}
                                {{--                                                                        Newly renovated by Master Architect Thierry--}}
                                {{--                                                                        Despont--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </a>--}}

                                {{--                                                            <!--=== event item ===-->--}}

                                {{--                                                            <a href="#">--}}
                                {{--                                                                <div class="event">--}}
                                {{--                                                                    <div class="date">--}}
                                {{--                                                                        <div class="date-card">--}}
                                {{--                                                                            <span>Sep</span>--}}
                                {{--                                                                            <strong>22</strong>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <div class="caption">--}}
                                {{--                                                                        Ideal venue for cocktail style rehearsal dinners--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </a>--}}

                                {{--                                                        </div> <!--/events-->--}}

                                {{--                                                    </div> <!--/text-->--}}
                                {{--                                                </div> <!--/item-->--}}
                                {{--                                                <div class="image"--}}
                                {{--                                                     style="background-image:url(assets/images/event-1.jpg)">--}}
                                {{--                                                    <img src="assets/images/event-1.jpg" alt=""/>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div> <!--/blocks-->--}}
                                {{--                                            <!--=== item block === -->--}}

                                {{--                                            <div class="blocks blocks-right">--}}
                                {{--                                                <div class="item">--}}
                                {{--                                                    <div class="text">--}}
                                {{--                                                        <div class="events">--}}

                                {{--                                                            <!--=== event item ===-->--}}

                                {{--                                                            <a href="#">--}}
                                {{--                                                                <div class="event">--}}
                                {{--                                                                    <div class="date">--}}
                                {{--                                                                        <div class="date-card">--}}
                                {{--                                                                            <span>Sep</span>--}}
                                {{--                                                                            <strong>28</strong>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <div class="caption">--}}
                                {{--                                                                        Newly renovated by Master Architect Thierry--}}
                                {{--                                                                        Despont--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </a>--}}

                                {{--                                                            <!--=== event item ===-->--}}

                                {{--                                                            <a href="#">--}}
                                {{--                                                                <div class="event">--}}
                                {{--                                                                    <div class="date">--}}
                                {{--                                                                        <div class="date-card">--}}
                                {{--                                                                            <span>Sep</span>--}}
                                {{--                                                                            <strong>22</strong>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <div class="caption">--}}
                                {{--                                                                        Ideal venue for cocktail style rehearsal dinners--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </a>--}}

                                {{--                                                        </div> <!--/events-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                {{--                                                <div class="image"--}}
                                {{--                                                     style="background-image:url(assets/images/event-2.jpg)">--}}
                                {{--                                                    <img src="assets/images/event-2.jpg" alt=""/>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                        </div> <!--/image-blocks-->--}}

                                {{--                                    </div> <!--/content-->--}}
                                {{--                                </div>--}}

                            </div> <!--/tab-content-->

                        </div> <!--/facility-addons-->
                    </div> <!--/col-md-10-->
                </div> <!--/row-->

            </div> <!--/container-->
        </div>


    </section>
    @include('frontend.pages.home.facilities')
    @include('frontend.pages.home.near')
@endsection
