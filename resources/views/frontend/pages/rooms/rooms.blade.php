<!-- ========================  Rooms ======================== -->

<section class="page">

    <!-- ========================  Page header ======================== -->

    <div class="page-header" style="background-image:url({{asset('assets/backend/images/header-1.jpg')}})">
        <div class="container">
            <h2 class="title">@lang('frontend.rooms') & @lang('frontend.suites')</h2>
            <p>@lang('frontend.room subtitle') </p>
        </div>
    </div>

    <!-- === rooms content === -->

    <div class="rooms rooms-category">
        <div class="container">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger pb-0">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                @foreach($rooms as $key=>$room)
                    <!-- === rooms item === -->
                    @if($key == 0 || $key == 1)
                        <div class="col-sm-6 col-md-6">
                            @else
                                <div class="col-sm-6 col-md-4">
                                    @endif

                                    <div class="item">
                                        <article>
                                            <div class="image">
                                                <img style="height: auto; aspect-ratio: 8/5;"
                                                     src="{{asset('uploads/rooms/'.$room->roomImage->first()->image)}}"
                                                     alt="{{$room->roomTranslation->first()->title}}"/>
                                            </div>
                                            <div class="details">
                                                <div class="text">
                                                    <h2 class="title"><a
                                                            href="{{route('front.room',[app()->getLocale(), $room->roomTranslation->first()->slug])}}">{{$room->parentRoomType->roomTypeTranslation->first()->title}}</a>
                                                    </h2>
                                                    <p>{{$room->roomTranslation->first()->title}}</p>
                                                </div>
                                                <div class="book">
                                                    <div>
                                                        <a href="{{route('front.room',[app()->getLocale(), $room->roomTranslation->first()->slug])}}"
                                                           class="btn btn-main">Book now</a>
                                                    </div>
                                                    <div>
                                                        <span class="price h2">₼ {{$room->price}}</span>
                                                        <span>per night</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                @endforeach
                        </div>

            </div> <!--/container-->
        </div>
</section>
