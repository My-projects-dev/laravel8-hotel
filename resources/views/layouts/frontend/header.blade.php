<!-- ========================  Header content ======================== -->
<header>

    <!-- ======================== Navigation ======================== -->

    <div class="container">

        <!-- === navigation-top === -->

        <nav class="navigation-top clearfix">

            <!-- navigation-top-left -->

            <div class="navigation-top-left">
                <a class="box" href="//{!! strip_tags(settings('facebook')) ?? ''!!}">
                    <i class="fa fa-facebook"></i>
                </a>
                <a class="box" href="//{!! strip_tags(settings('twitter')) ?? ''!!}">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="box" href="//{{strip_tags(settings('youtube')) ?? ''}}">
                    <i class="fa fa-youtube"></i>
                </a>
            </div>

            <!-- navigation-top-right -->

            <div class="navigation-top-right">
                <a class="box" href="#">
                    <i class="icon icon-phone-handset"></i>
                    {!! strip_tags(settings('phone')) ?? '' !!}
                </a>
            </div>
        </nav>

        <!-- === navigation-main === -->

        <nav class="navigation-main clearfix">

            <!-- logo -->

            <div class="logo animated fadeIn">
                <a href="{{route('home',app()->getLocale())}}">
                    <img class="logo-desktop" src="{{asset('assets/frontend/images/logo.png')}}" alt="Alternate Text"/>
                    <img class="logo-mobile" src="{{asset('assets/frontend/images/logo-mobile.png')}}"
                         alt="Alternate Text"/>
                </a>
            </div>

            <!-- toggle-menu -->

            <div class="toggle-menu"><i class="icon icon-menu"></i></div>

            <!-- navigation-block -->

            <div class="navigation-block clearfrontend.fix">

                <!-- navigation-left -->

                <ul class="navigation-left">
                    <li>
                        <a href="{{route('home',app()->getLocale())}}">@lang('frontend.home')</a>
                    </li>
                    <li>
                        <a href="{{route('front.rooms',app()->getLocale())}}">@lang('frontend.rooms')</a>
                    </li>
                    <li>
                        <a href="{{route('front.about',app()->getLocale())}}">@lang('frontend.about')</a>
                    </li>
                </ul>

                <!-- navigation-right -->

                <ul class="navigation-right">
                    <li>
                        <a href="{{route('front.facility',app()->getLocale())}}">@lang('frontend.facilities')</a>
                    </li>
                    <li>
                        <a href="{{route('front.blogs',app()->getLocale())}}">@lang('frontend.blog') </a>
                    </li>
                    <li>
                        <a href="{{route('front.contact',app()->getLocale())}}">@lang('frontend.contact')</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown"><span style="color:white">{{app()->getLocale()}}</span> <span class="open-dropdown" style="color:white"><i class="fa fa-angle-down"></i></span></a>
                            <div class="dropdown-menu">
                                @php($languages = config('translatable.locales'))
                                @foreach($languages as $lang)
                                <a class="dropdown-item" href="{{route(Route::currentRouteName(), $lang)}}">{{$lang}}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>

            </div> <!--/navigation-block-->

        </nav>
    </div> <!--/container-->

</header>
