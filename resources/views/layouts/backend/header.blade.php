<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header">
    <a href="{{route('dashboard')}}" class="brand-logo">

        <h1><b><i class="text-primary">Colina</i></b></h1>
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->
<!--**********************************
            Header start
        ***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        {{$page}}
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link ai-icon" href="{{route('comment.index')}}" role="button">
                            <svg width="20" height="24" viewBox="0 0 20 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M8.83333 3.91738V1.50004C8.83333 0.856041 9.356 0.333374 10 0.333374C10.6428 0.333374 11.1667 0.856041 11.1667 1.50004V3.91738C12.9003 4.16704 14.5208 4.97204 15.7738 6.22504C17.3057 7.75687 18.1667 9.8347 18.1667 12V16.3914L19.1105 18.279C19.562 19.1832 19.5142 20.2565 18.9822 21.1164C18.4513 21.9762 17.5122 22.5 16.5018 22.5H11.1667C11.1667 23.144 10.6428 23.6667 10 23.6667C9.356 23.6667 8.83333 23.144 8.83333 22.5H3.49817C2.48667 22.5 1.54752 21.9762 1.01669 21.1164C0.484686 20.2565 0.436843 19.1832 0.889509 18.279L1.83333 16.3914V12C1.83333 9.8347 2.69319 7.75687 4.22502 6.22504C5.47919 4.97204 7.0985 4.16704 8.83333 3.91738ZM10 6.1667C8.45183 6.1667 6.96902 6.78154 5.87469 7.87587C4.78035 8.96904 4.16666 10.453 4.16666 12V16.6667C4.16666 16.8475 4.12351 17.026 4.04301 17.1882C4.04301 17.1882 3.52384 18.2265 2.9755 19.322C2.88567 19.5029 2.89501 19.7187 3.00117 19.8902C3.10734 20.0617 3.29517 20.1667 3.49817 20.1667H16.5018C16.7037 20.1667 16.8915 20.0617 16.9977 19.8902C17.1038 19.7187 17.1132 19.5029 17.0234 19.322C16.475 18.2265 15.9558 17.1882 15.9558 17.1882C15.8753 17.026 15.8333 16.8475 15.8333 16.6667V12C15.8333 10.453 15.2185 8.96904 14.1242 7.87587C13.0298 6.78154 11.547 6.1667 10 6.1667Z"
                                      fill="#1362FC"/>
                            </svg>
                            <div>{{comment()}}</div>
                        </a>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            {{--                            <img src="images/profile/pic1.jpg" alt="">--}}
                            <div class="header-info ms-3">
                                <span>{{Auth::user()->name}}</span>
                                {{--                                <small>Superadmin</small>--}}
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">


                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item ai-icon">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
