@extends('layouts.frontend.master')
@section('content')
    <!-- ========================  Blog ======================== -->

    <section class="page">

        <!-- ===  Page header === -->

        <div class="page-header" style="background-image:url({{asset('assets/frontend/images/header-1.jpg')}}">
            <div class="container">
                <h2 class="title">@lang('frontend.blog')</h2>
                <p>@lang('frontend.blog subtitle')</p>
            </div>
        </div>

        <!-- ===  Blog item === -->

        <div class="blog blog-item">
            <div class="container">

                <div class="row">

                    <!-- === blog-content === -->

                    <div>

                        <article>

                            <!--=== blog image ===-->

                            <div class="image">
                                <img src="{{asset('uploads/blogs/'.$blog->parentBlog->image)}}" alt="{{$blog->title}}" />
                            </div>

                            <!--=== blog content ===-->

                            <div class="content">

                                <!--=== blog title ===-->

                                <div class="h1 title">
                                    {{$blog->title}}
                                </div>

                                <p>{!! $blog->content !!}</p>
                            </div>

                            <!-- === blog comments === -->
                        </article>

                    </div>

                </div> <!--/row-->


            </div><!--/container-->
        </div> <!--/blog-item-->
    </section>
@endsection
