<!-- ======================== Quotes ======================== -->

<section class="quotes quotes-slider" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
    <div class="container">

        <!-- === Quotes header === -->

        <div class="section-header">
            <h2 class="title">@lang('frontend.testimonials')</h2>
            <p>@lang('frontend.testimonials subtitle')</p>
        </div>

        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="quote-carousel">
                    @foreach($testimonials  as $testimonial)
                        <!-- === quoute item === -->

                        <div class="quote">

                            <div class="text">
                                <h4>{{$testimonial->testimonialTranslation->first()->full_name}}</h4>
                                <p>{{$testimonial->testimonialTranslation->first()->comment}}</p>
                            </div>
                            <div class="more">
                                <div class="rating">
                                    @for($i=0; $i<$testimonial->star; $i++)
                                    <span class="fa fa-star"></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!--/quote-carousel-->
            </div>
        </div> <!--/row-->
    </div> <!--/container-->
</section>
