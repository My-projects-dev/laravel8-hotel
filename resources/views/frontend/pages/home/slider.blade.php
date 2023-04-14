<!-- ========================  Slider ======================== -->

<section class="frontpage-slider">
    <div class="owl-slider owl-slider-header owl-slider-fullscreen">

        @foreach($sliders as $slider)
            <!-- === slide item === -->

            <div class="item"
                 style="background-image:url({{asset('uploads/sliders/'.$slider->image)}})">
                <div class="box text-center">
                    <div class="container">
                        @if($slider->star!=0)
                            <div class="rating animated" data-animation="fadeInDown">
                                @for($i=0;$i<$slider->star; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                        @endif
                        <h2 class="title animated h1" data-animation="fadeInDown">
                            {{$slider->sliderTranslation->first()->title}}
                        </h2>
                        <div class="desc animated" data-animation="fadeInUp">
                            {{$slider->sliderTranslation->first()->subtitle}}
                        </div>
{{--                        <div class="desc animated" data-animation="fadeInUp">--}}
{{--                            and unforgettable weddings.--}}
{{--                        </div>--}}
                        <div class="animated" data-animation="fadeInUp">
                            @empty(!$slider->sliderTranslation->first()->button_title)
                                <a href="{{$slider->sliderTranslation->first()->button_url}}"
                                   class="btn btn-clean">{{$slider->sliderTranslation->first()->button_title}}</a>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div> <!--/owl-slider-->
</section>
