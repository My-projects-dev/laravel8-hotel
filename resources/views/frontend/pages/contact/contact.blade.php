@extends('layouts.frontend.master')
@section('content')
    <!-- ======================== Contact ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
            <div class="container">
                <h2 class="title">@lang('frontend.contact')</h2>
                <p>@lang('frontend.contact subtitle')</p>
            </div>
        </div>

        <!-- ===  Contact === -->

        <div class="contact">

            <div class="container">

                <!-- === Google map === -->

                <div class="map" id="map"></div>

                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                        <!-- === Contact block === -->

                        <div class="contact-block">

                            <!-- === Contact banner === -->

                            <div class="banner">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10 text-center">
                                        <h2 class="title">@lang('frontend.send and email')</h2>
                                        <p>@lang('frontend.email subtitle')</p>

                                        <div class="contact-form-wrapper">

                                            <a class="btn btn-clean open-form" data-text-open="@lang('frontend.contact button title')"
                                               data-text-close="@lang('frontend.contact button title2')">@lang('frontend.contact button title')</a>

                                            <div class="contact-form clearfix">
                                                <form action="{{route('comment.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" value="{{ old('name') }}"
                                                                       class="form-control" name="name"
                                                                       placeholder="Your name" required="required">
                                                                @error('name')
                                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="email" value="{{ old('name') }}"
                                                                       class="form-control" name="email"
                                                                       placeholder="Your email" required="required">
                                                                @error('email')
                                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="form-group">
                                                                <input type="text" value="{{ old('name') }}"
                                                                       class="form-control" name="subject"
                                                                       placeholder="Subject" required="required">
                                                                @error('subject')
                                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="comment"
                                                                          placeholder="Your message"
                                                                          rows="10">{{ old('name') }}</textarea>
                                                                @error('comment')
                                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <input type="submit" class="btn btn-clean"
                                                                   value="@lang('frontend.send message')"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- === Contact info === -->

                            <div class="contact-info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-map-marker"></span>
                                            <figcaption>
                                                <strong>@lang('frontend.location')</strong>
                                                <span>{!! settings('location') ?? '' !!}</span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-phone"></span>
                                            <figcaption>
                                                <strong>@lang('frontend.call')</strong>
                                                <span>
                                                       {!! settings('call') ?? '' !!}
                                                    </span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-clock"></span>
                                            <figcaption>
                                                <strong>@lang('frontend.hours')</strong>
                                                <span>
                                                        {!! settings('working-hours') ?? '' !!}
                                                    </span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </div>

                        </div> <!--/contact-block-->
                    </div><!--col-sm-8-->
                </div> <!--/row-->
            </div> <!--/container-->
        </div> <!--/contact-->
    </section>
@endsection
