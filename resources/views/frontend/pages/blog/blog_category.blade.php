@extends('layouts.frontend.master')
@section('content')
    <!-- ========================  Blog ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}})">
            <div class="container">
                <h2 class="title">@lang('frontend.blog')</h2>
                <p>@lang('frontend.blog subtitle')</p>
            </div>
        </div>

        <!-- ===  Blog === -->

        <div class="blog blog-category">

            <div class="container">

                <div class="row">

                    <!-- === blog-content === -->

                    <div>

                        <div class="row">

                            @foreach($blogs as $key=>$blog)
                                <!-- === article item === -->

                                <div class="col-sm-6 col-md-{{($key==0 || $key==1) ? 6 : 4}}">
                                    <a href="{{route('front.blog',[app()->getLocale(), $blog->blogTranslation->first()->slug])}}">
                                        <article>
                                            <div class="image">
                                                <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="{{$blog->blogTranslation->first()->title}}"
                                                style=" height: auto; aspect-ratio: 8/5;" />
                                            </div>
                                            <div class="text">
                                                <div class="time">
                                                    <span>{{date('d', strtotime($blog->created_at))}}</span>
                                                    <span>{{date('m', strtotime($blog->created_at))}}</span>
                                                    <span>{{date('Y', strtotime($blog->created_at))}}</span>
                                                </div>
                                                <h2 class="h4 title">
                                                    {{$blog->blogTranslation->first()->title}}
                                                </h2>
                                            </div>
                                        </article>
                                    </a>
                                </div>
                            @endforeach

                        </div>

                        <!-- === pagination === -->

                        <div class="d-flex justify-content-center">{!! $blogs->links() !!}</div>

                    </div>

                </div> <!--/row-->


            </div><!--/container-->
        </div> <!--/blog-category-->
    </section>
@endsection
