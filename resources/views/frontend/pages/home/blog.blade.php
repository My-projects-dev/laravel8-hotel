<!-- ========================  Blog ======================== -->

<section class="blog blog-widget">

    <!-- === stretcher header === -->

    <div class="section-header">
        <div class="container">
            <h2 class="title">@lang('frontend.latest') @lang('frontend.news') <a href="{{route('front.blogs',app()->getLocale())}}"
                                             class="btn btn-sm btn-clean-dark">@lang('frontend.explore more')</a></h2>
            <p>
                {!! settings('latest-news') ?? '' !!}
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($blogs  as $blog)
                <!-- === article item === -->

                <div class="col-sm-4">
                    <a href="{{route('front.blog',[app()->getLocale(), $blog->blogTranslation->first()->slug])}}">
                        <article>
                            <div class="image">
                                <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="{{$blog->blogTranslation->first()->title}}" style=" height: auto; aspect-ratio: 8/5;"/>
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

        </div> <!--/row-->
    </div> <!--/container-->
</section>
