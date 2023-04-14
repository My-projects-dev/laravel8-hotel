<!-- === Our team === -->

<div class="team">

    <div class="row">

        @foreach($teams  as $team)
            <!-- === team member === -->

            <div class="col-sm-3">
                <article>
                    <div class="details details-text">
                        <div class="inner">
                            <h4 class="title">{{$team->teamTranslation->first()->full_name}}</h4>
                            <h6 class="title">{{$team->teamTranslation->first()->position}}</h6>
                        </div>
                    </div>
                    <div class="image">
                        <img src="{{asset('uploads/teams/'.$team->image)}}" alt="{{$team->teamTranslation->first()->full_name}}"/>
                    </div>
                    <div class="details details-social">
                        <div class="inner">
                            <a href="{{$team->facebook ?? ''}}"><i class="fa fa-facebook"></i></a>
                            <a href="{{$team->email ?? ''}}"><i class="fa fa-envelope"></i></a>
                            <a href="{{$team->twitter ?? ''}}"><i class="fa fa-twitter"></i></a>
                            <a href="{{$team->linkedin ?? ''}}"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach

    </div> <!--/row-->

</div> <!--/team-->
