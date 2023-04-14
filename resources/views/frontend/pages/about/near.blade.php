<!-- === text-card === -->

<div class="text-block">
    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <h2>@lang('frontend.luxury')</h2>
            <p>
                {!! settings('luxury-about') ?? '' !!}
            </p>
            <h2>@lang('frontend.near') @lang('frontend.by')</h2>
            <p>
                {!! settings('near-by-about') ?? '' !!}
            </p>

            <div class="cards cards-block">

                <div class="row">

                    @foreach($nearbies as $key=>$near)
                        @php($key++)
                    <!-- === item === -->

                    <div class="col-xs-{{$loop->first ? 12 : 6}} col-md-{{$key % 3 ==0 ? 12 : 6}}">
                        <figure>
                            <figcaption style="background-image:url({{asset('uploads/nearbies/'.$near->image)}})">
                                <img src="{{asset('uploads/nearbies/'.$near->image)}}" alt=""/>
                            </figcaption>
                            <a href="{{$near->nearTranslation->first()->button_url}}" class="btn btn-clean" onclick="">{{$near->nearTranslation->first()->button_title}}</a>
                        </figure>
                    </div>
                    @endforeach

                </div> <!--/row-->

            </div> <!--/cards-->

        </div> <!--/col-->
    </div> <!--/row-->
</div>
