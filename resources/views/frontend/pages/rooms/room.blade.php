<!-- ========================  Room ======================== -->

<section class="page">


    <!-- ===  Page header === -->

    <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
        <div class="container">
            <h2 class="title">{{$room->parentRoom->parentRoomType->roomTypeTranslation->first()->title}}</h2>
            <p>Available from {{$room->parentRoom->price}}₼ per night</p>
        </div>
    </div>

    <div class="room">
        <div class="container">
            @if ($message = Session::get('error'))
                <script>
                    alert('{{ Session::get('error') }}');
                </script>
            @endif
        </div>
        <!-- === Room gallery === -->

        <div class="room-gallery">
            <div class="container">
                <div class="owl-slider owl-theme owl-slider-gallery">

                    @foreach($room->parentRoom->roomImage as $img)
                        <!-- === slide item === -->

                        <div class="item" style="background-image:url({{asset('uploads/rooms/'.$img->image)}})">
                            <img src="{{asset('uploads/rooms/'.$img->image)}}" alt=""/>
                        </div>
                    @endforeach

                </div> <!--/owl-slider-->

            </div>
        </div> <!--/room-gallery-->

        <!-- === Booking === -->
        @include('frontend.pages.rooms.booking')

        <!-- ===  Room overview === -->

        <div class="room-overview">

            <div class="container">
                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                        <!-- === Room aminities === -->

                        <div class="room-block room-aminities">

                            <h2 class="title">Room aminities</h2>

                            <div class="row">

                                {{--                                $room->parentRoom->parentRoomType->roomTypeTranslation->first()->title--}}

                                @foreach($room->parentRoom->roomAmenity as $roomAmenity)
                                    <!--=== item ===-->
                                    <div class="col-xs-6 col-sm-2">
                                        <figure>
                                            <figcaption>
                                                <span class="{{$roomAmenity->parentAmenity->icon}}"></span>
                                                <p>{{$roomAmenity->parentAmenity->roomAmenityTranslation->first()->title}}</p>
                                            </figcaption>
                                        </figure>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <!-- === Room block === -->

                        <div class="room-block">
                            <h2 class="title">Room overview</h2>
                            {!! $room->first()->overview !!}
                        </div>

                        <!-- === Room block === -->

                        <div class="room-block">

                            <h2 class="title">House rules</h2>

                            <!-- === box === -->

                            <div class="box">
                                <div class="row">
                                    {!! $room->first()->rules !!}
                                </div>
                            </div>
                        </div>

                    </div> <!--/col-sm-10-->
                </div> <!--/row-->
            </div> <!--/container-->
        </div> <!--/room-overview-->
    </div>

</section>
