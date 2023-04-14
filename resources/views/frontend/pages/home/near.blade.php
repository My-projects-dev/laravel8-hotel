<!-- ========================  Cards ======================== -->

<section class="cards">

    <!-- === cards header === -->

    <div class="section-header">
        <div class="container">
{{--            <h2 class="title">Near by <a href="#" class="btn btn-sm btn-clean-dark">View all</a></h2>--}}
            <h2 class="title">@lang('frontend.near') @lang('frontend.by') </h2>
            <p>{!! settings('near-by') ?? '' !!}</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($nearbies  as $near)
                <!-- === item === -->

                <div class="col-xs-{{$loop->first ? 12 : 6}} col-md-{{$loop->first ? 8 : 4}}">
                    <figure>
                        <figcaption
                            style="background-image:url({{asset('uploads/nearbies/'.($near->image ?? ''))}})">
                            <img src="{{asset('uploads/nearbies/'.($near->image ?? ''))}}"
                                 alt="{{$near->nearTranslation->first()->button_title}}"/>
                        </figcaption>
                        <a href="{{$near->nearTranslation->first()->button_url}}" class="btn btn-clean" onclick="">{{$near->nearTranslation->first()->button_title}}</a>
                    </figure>
                </div>
            @endforeach
        </div> <!--/row-->

    </div> <!--/container-->
</section>
