@extends('layouts.frontend.master')
@section('content')
    <!-- ======================== About ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
            <div class="container">
                <h2 class="title">@lang('frontend.the hotel')</h2>
                <p>@lang('frontend.about hotel subtitle')</p>
            </div>
        </div>

        <div class="image-blocks image-blocks-category">

            <div class="container">
                <div class="about">

                    <!--text-block-->

                    <div class="text-block">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="text">
                                    @foreach($abouts as $about)
                                        <h2>@lang('frontend.about colina hotel')</h2>

                                        <!-- ===  Gallery === -->

                                        <div class="gallery">

                                            <div class="owl-slider owl-slider-gallery">

                                                @foreach ($about->aboutImage as $img)
                                                    <!-- === slide item === -->

                                                    <div class="item"
                                                         style="background-image:url({{asset('uploads/abouts/'.$img->image)}})"></div>
                                                @endforeach


                                            </div> <!--/owl-slider-->

                                        </div>

                                        {!! $about->aboutTranslation->first()->content !!}

                                    @endforeach
                                </div>

                                <h2>@lang('frontend.meet our team')</h2>

                                <p>
                                    {!! strip_tags(settings('team')) ?? '' !!}
                                </p>
                                @include('frontend.pages.about.team')
                            </div> <!--/col-->
                        </div> <!--/row-->
                    </div>

                    @include('frontend.pages.about.information')
                    @include('frontend.pages.about.near')

                </div> <!--/container-->

            </div>
        </div>
    </section>
@endsection
