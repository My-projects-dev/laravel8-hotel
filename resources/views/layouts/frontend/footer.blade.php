<!-- ================== Footer  ================== -->

<footer>
    <div class="container">

        <!--footer links-->
{{--        <div class="footer-links">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6 footer-left">--}}
{{--                    <a href="#">Sitemap</a> &nbsp; | &nbsp; <a href="#">Privacy policy</a> | &nbsp; <a href="#">Guest--}}
{{--                        book</a>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6 footer-right">--}}
{{--                    <a href="#">Gallery</a> &nbsp; | &nbsp; <a href="#">Reservations</a> | &nbsp; <a href="#">Help--}}
{{--                        center</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!--footer social-->

        <div class="footer-social">
            <div class="row">
                <div class="col-sm-12 text-center hidden">
                    <a href="" class="footer-logo"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="Alternate Text"/></a>
                </div>
                <div class="col-sm-12 icons">
                    <ul>
                        <li><a href="//{!! strip_tags(settings('facebook')) ?? ''!!}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="//{!! strip_tags(settings('twitter')) ?? ''!!}"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="//{!! strip_tags(settings('email')) ?? ''!!}"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="//{!! strip_tags(settings('youtube')) ?? ''!!}"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="//{!! strip_tags(settings('instagram')) ?? ''!!}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-sm-12 text-center">
                    <img src="{{asset('assets/frontend/images/logo-footer.png')}}" alt=""/>
                </div>
            </div>
        </div>
    </div>
</footer>
