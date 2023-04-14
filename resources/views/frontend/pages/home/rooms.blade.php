<!-- ========================  Rooms ======================== -->

<section class="rooms rooms-widget">

    <!-- === rooms header === -->

    <div class="section-header">
        <div class="container">
            <h2 class="title">@lang('frontend.rooms') @lang('frontend.accommodation') <a href="{{route('front.rooms',app()->getLocale())}}" class="btn btn-sm btn-clean-dark">
                    @lang('frontend.view')</a></h2>
            <p>{!! settings('rooms-accommodation') ?? '' !!}</p>
        </div>
    </div>

    <!-- === rooms content === -->

    <div class="container">

        <div class="owl-rooms owl-theme">

            @foreach($rooms as $room)
                <!-- === rooms item === -->

                <div class="item">
                    <article>
                        <div class="image">
                            <img style="height: auto; aspect-ratio: 8/5;" src="{{asset('uploads/rooms/'.$room->roomImage->first()->image)}}" alt="{{$room->roomTranslation->first()->title}}"/>
                        </div>
                        <div class="details">
                            <div class="text">
                                <h3 class="title"><a href="{{route('front.room',[app()->getLocale(), $room->roomTranslation->first()->slug])}}">{{$room->parentRoomType->roomTypeTranslation->first()->title}}</a></h3>
                                <p>{{$room->roomTranslation->first()->title}}</p>
                            </div>
                            <div class="book">
                                <div>
                                    <a href="{{route('front.room',[app()->getLocale(), $room->roomTranslation->first()->slug])}}" class="btn btn-main">Book now</a>
                                </div>
                                <div>
                                    <span class="price h4">₼ {{$room->price}}</span>
                                    <span>per night</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach

        </div><!--/owl-rooms-->

    </div> <!--/container-->

</section>
