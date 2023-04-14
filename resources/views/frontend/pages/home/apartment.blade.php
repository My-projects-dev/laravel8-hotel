<!-- ======================== Image blocks ======================== -->

<section class="image-blocks image-blocks-header">

    <div class="section-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
        <div class="container">
            <h2 class="title">@lang('frontend.apartment') @lang('frontend.residences') <a href="{{route('front.rooms',app()->getLocale())}}" class="btn btn-sm btn-clean">
                    @lang('frontend.view')</a></h2>
            <p>{!! settings('apartment-residences') ?? '' !!}</p>
        </div>
    </div>

    <div class="container">

        @foreach($apartment as $room)
            <!--item block -->
            <div class="blocks blocks-{{$loop->first ? 'left' : 'right'}}">
                <div class="item">
                    <div class="text">

                        <!-- === room info === -->

                        <h2 class="title">{{$room->parentRoomType->roomTypeTranslation->first()->title}}</h2>
                        <p>
                            {!! $room->roomTranslation->first()->overview !!}
                        </p>

                        <!-- === room facilities === -->

                        <div class="room-facilities">
                            @foreach($room->roomAmenity as $roomAmenity)
                                <!--=== icon ===-->

                                <figure>

                                    <figcaption><i class="{{$roomAmenity->parentAmenity->icon}}"></i>
                                        {{$roomAmenity->parentAmenity->roomAmenityTranslation->first()->title}}
                                    </figcaption>

                                </figure>
                            @endforeach
                        </div>

                        <!-- === booking === -->

                        <div class="book">
                            <div>
                                <a href="{{route('front.blogs',app()->getLocale())}}" class="btn btn-danger btn-lg">Book</a>
                            </div>
                            <div>
                                <span class="price h2">₼ {{$room->price}}</span>
                                <span>per night</span>
                            </div>
                        </div> <!--/booking-->

                    </div><!--/text-->
                </div> <!--/item-->

                <div class="image" style="background-image:url({{asset('uploads/rooms/'.$room->roomImage->first()->image)}})">
                    <img src="{{asset('uploads/rooms/'.$room->roomImage->first()->image)}}" alt="{{$room->roomTranslation->first()->title}}"/>
                </div>
            </div>
        @endforeach

    </div> <!--/container-->
</section>
