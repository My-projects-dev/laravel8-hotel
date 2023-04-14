<!-- ========================  Stretcher widget ======================== -->

<section class="stretcher-wrapper">

    <!-- === stretcher header === -->

    <div class="section-header">
        <div class="container">
            <h2 class="title">@lang('frontend.resort') @lang('frontend.facilities') <a href="{{route('front.facility',app()->getLocale())}}" class="btn btn-sm btn-clean-dark">
                    @lang('frontend.explore more')</a></h2>
            <p>
                {!! settings('resort-facilities') ?? '' !!}
            </p>
        </div>
    </div>

    <!-- === stretcher === -->

    <ul class="stretcher">

        @foreach($facilities  as $facility)
            <!-- === stretcher item === -->

            <li class="stretcher-item"
                style="background-image:url({{asset('uploads/facilities/'.($facility->image ?? ''))}});">

                <!--logo-item-->
                <div class="stretcher-logo">
                    <div class="text">
                        <span class="text-intro h4">{{$facility->facilityTranslation->first()->title}}</span>
                    </div>
                </div>
                <!--main text-->
                <figure>
                    <h4>{{$facility->facilityTranslation->first()->title}}</h4>
                    <figcaption>{{$facility->facilityTranslation->first()->description}}</figcaption>
                </figure>
                <!--anchor-->
                <a href="{{route('front.facility',app()->getLocale())}}">Anchor link</a>
            </li>
        @endforeach
        <!-- === stretcher item more === -->

        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="{{route('front.facility',app()->getLocale())}}">Anchor link</a>
        </li>
    </ul>
</section>
