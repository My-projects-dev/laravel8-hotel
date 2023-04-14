<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">About</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('about.create')}}">About</a></li>
                    <li><a href="{{route('info.index')}}">Information</a></li>
                    <li><a href="{{route('near.index')}}">NearBy</a></li>
                    <li><a href="{{route('team.index')}}">Team</a></li>
                </ul>
            </li>
            @if(Auth::user()->id==1)
                <li><a href="{{route('admin.index')}}"><i class="nav-icon fa fa-users"></i>Admins</a></li>
            @endif
            <li><a href="{{route('blog.index')}}"><i class="nav-icon fa fa-blog"></i>Blog</a></li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-comment"></i>
                    <span class="nav-text">Comment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('comment.index')}}">Comments</a></li>
                    <li><a href="{{route('testimonial.index')}}">Testimonial</a></li>
                </ul>
            </li>
            <li><a href="{{route('reservation.index')}}"><i class="fas fa-calendar-alt"></i>Reservation</a></li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-hotel"></i>
                    <span class="nav-text">Rooms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('addition.index')}}">Addition</a></li>
                    <li><a href="{{route('amenity.index')}}">Room Amenity</a></li>
                    <li><a href="{{route('roomtype.index')}}">Room Types</a></li>
                    <li><a href="{{route('room.index')}}">Rooms</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-concierge-bell"></i>
                    <span class="nav-text">Services</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('chef.index')}}">Chef</a></li>
                    <li><a href="{{route('facility.index')}}">Facility</a></li>
                    <li><a href="{{route('facility_slider.index')}}">Facility Slider</a></li>
                    <li><a href="{{route('menu.index')}}">Menu</a></li>
                </ul>
            </li>

            <li><a href="{{route('setting.index')}}"><i class="nav-icon fas fa-cog"></i>Setting</a></li>
            <li><a href="{{route('slider.index')}}"><i class="fas fa-sliders-h"></i>Slider</a></li>

        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
