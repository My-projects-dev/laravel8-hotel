@foreach($informations as $key => $info)

    <!--=== item block === -->

    <div class="blocks blocks-{{$key%2==0 ? 'left':'right'}}">
        <div class="item">
            <div class="text">
                <div class="h2">{{$info->infoTranslation->first()->title}}</div>
                {!! $info->infoTranslation->first()->content !!}
            </div>
        </div>
        <div class="image" style="background-image:url({{asset('uploads/info/'.$info->image)}})">
            <img src="{{asset('uploads/info/'.$info->image)}}" alt="{{$info->infoTranslation->first()->title}}">
        </div>
    </div>
@endforeach
