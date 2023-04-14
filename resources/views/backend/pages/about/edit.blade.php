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
                                    @foreach($abouts as $key => $about)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <form action="{{route('about.update',$about->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                @foreach ($about->parentAbout->aboutImage as $img)
                                                    <div class="form-group row mb-5" id="{{'image-'.$img->id}}">

                                                        <div class="col-3">
                                                            <img src="{{asset('uploads/abouts/'.$img->image)}}" alt=""
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

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($about->parentAbout->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($about->parentAbout->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                <br>
                                                Content<br>
                                                <textarea class="form-control" name="content" required
                                                          id="{{'content_'.$languages[$key]}}">{{$about->content}}</textarea>
                                                @error('content')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

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
        CKEDITOR.replace({{'content_'.$language}});
        @endforeach
    </script>

    <script>

        $(document).on('click', '.delete-item', function (e) {
            e.preventDefault();

            var item_id = $(this).data('id');

            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('about.image.destroy', ['id' => ':id']) }}",
                    data: {
                        'id': item_id,
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        alert(data.message);
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
