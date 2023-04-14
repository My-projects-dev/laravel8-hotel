@extends('layouts.backend.master')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success pb-0">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger pb-0">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a href="{{route('room.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of rooms
                        </a>
                        <a href="{{route('room.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add room
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($languages as $key=>$language)
                                        <li class="nav-item">
                                            <a class="nav-link {{$loop->first ? 'active' : ''}}" data-toggle="tab"
                                               href="{{'#'.$language}}">{{strtoupper($language)}}</a>
                                        </li>
                                @endforeach
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach($rooms as $key => $room)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <form action="{{route('room.update',$room->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                @foreach ($images as $img)
                                                    <div class="form-group row mb-5" id="{{'image-'.$img->id}}">
                                                        <div class="col-2">
                                                            <lebel>Main image</lebel>
                                                            <input type="radio" name="main" value="{{$img->id}}"
                                                                   {{($img->main == 1) ? 'checked' : ''}} class="mr-3">
                                                        </div>
                                                        <div class="col-3">
                                                            <img src="{{asset('uploads/rooms/'.$img->image)}}" alt=""
                                                                 width="100"
                                                                 height="100">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="hidden" name="id[]" value="{{$img->id}}">
                                                            <input type="file" name="image[]" class="form-control">
                                                            @error('image.*')
                                                            <p class="text-danger mb-1">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4">

                                                            <a href="#" data-id="{{ $img->id }}"
                                                               class="btn btn-sm btn-danger text-right delete-item">
                                                                Delete Image</a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="form-group mb-4">
                                                    <label for="images">Yeni şəkil əlavə et</label>
                                                    <input type="file" multiple name="images[]" class="form-control">
                                                    @error('images')
                                                    <p class="text-danger mb-1">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                Room type <br>
                                                <select class="custom-select form-control mb-4" id="type" name="type">
                                                    @foreach ($room_types as $type)
                                                        <option
                                                            value="{{$type->parentRoomType->id}}"
                                                            {{($room->parentRoom->room_type_id ==$type->parentRoomType->id) ? 'selected' : ''}}>{{$type->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($room->parentRoom->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($room->parentRoom->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Price <br>
                                                <input type="number" name="price" class="form-control mb-4" min="0"
                                                       value="{{$room->parentRoom->price}}"
                                                       step="0.01">
                                                @error('price')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Number of rooms<br>
                                                <input type="number" name="number_of_rooms" class="form-control" min="0"
                                                       value="{{$room->parentRoom->number_of_rooms}}">
                                                @error('number_of_rooms')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Adults <br>
                                                <input type="number" name="adult" class="form-control mb-4" min="0"
                                                       value="{{$room->parentRoom->adult}}">
                                                @error('adult')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Children <br>
                                                <input type="number" name="child" class="form-control mb-4" min="0"
                                                       value="{{$room->parentRoom->child}}">
                                                @error('child')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Title <br>
                                                <input type="text" name="title" class="form-control mb-4"
                                                       id="title" value="{{$room->title}}">
                                                @error('title')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Slug <br>
                                                <input type="text" name="slug" class="form-control mb-4"
                                                       id="slug" value="{{$room->slug}}">
                                                @error('slug')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Overview <br>
                                                <textarea class="form-control" name="overview" required
                                                          id="{{'overview_'.$languages[$key]}}">{{$room->overview}}</textarea>
                                                @error('overview')
                                                <p class="text-danger mb-1">{{$message }}</p>
                                                @enderror

                                                <br>
                                                Rules<br>
                                                <textarea class="form-control" name="rules" required
                                                          id="{{'rules_'.$languages[$key]}}">{{$room->rules}}</textarea>
                                                @error('rules')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                <div class="row my-5">
                                                    @foreach ($amenities as $amenity)
                                                        <di class="col-md-4">
                                                            <label>
                                                                <input type="checkbox" name="amenity[]"
                                                                       value="{{$amenity->parentAmenity->id}}"
                                                                    {{(in_array($amenity->parentAmenity->id, $room_amenity) == true) ? 'checked' : ''}}>
                                                                {{$amenity->title}}
                                                            </label><br>
                                                        </di>
                                                    @endforeach
                                                    @error('amenity.*')
                                                    <p class="text-danger mb-1">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-warning mt-2"> Edit</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--                            /.card--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @foreach($languages as $language)
        CKEDITOR.replace({{'overview_'.$language}});
        CKEDITOR.replace({{'rules_'.$language}});
        @endforeach
    </script>

    <script>
        $('#slug').change(function (e) {
            $.get('{{ url('backend/check_slug') }}',
                {'title': $(this).val()},
                function (data) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>

    <script>
        $(document).on('click', '.delete-item', function (e) {
            e.preventDefault();

            var item_id = $(this).data('id');

            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('image.destroy', ['id' => $img->id]) }}",
                    data: {
                        'id': item_id,
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        alert(data.message);
                        // remove the deleted item from the DOM
                        $('#image-' + item_id).remove();
                    },
                    error: function () {
                        alert('Error! Please try again.');
                    }
                });
            }
        });

    </script>

@endsection
