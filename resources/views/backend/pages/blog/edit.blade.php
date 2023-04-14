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
                        <a href="{{route('blog.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of blogs
                        </a>
                        <a href="{{route('blog.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add blog
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
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach($blogs as $key => $blog)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <div class="text-center mt-5">
                                                <div class="text-center mt-5">
                                                    @if($blog->parentBlog->image)
                                                        <img class="border border-primary"
                                                             src="{{asset('uploads/blogs/'.$blog->parentBlog->image)}}"
                                                             alt="{{$blog->title}}"
                                                             height="300">
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="{{route('blog.update',$blog->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                <div class="form-group mb-4">
                                                    <label for="images">Add new image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @error('image')
                                                    <p class="text-danger mb-1">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($blog->parentBlog->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($blog->parentBlog->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Title <br>
                                                <input type="text" name="title" class="form-control mb-4"
                                                       id="title" value="{{$blog->title}}">
                                                @error('title')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Slug <br>
                                                <input type="text" name="slug" class="form-control mb-4"
                                                       id="slug" value="{{$blog->slug}}">
                                                @error('slug')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                <br>
                                                Content<br>
                                                <textarea class="form-control" name="content" required
                                                          id="{{'content_'.$languages[$key]}}">{{$blog->content}}</textarea>
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
        $('#slug').change(function (e) {
            $.get('{{ url('backend/check_slug') }}',
                {'title': $(this).val()},
                function (data) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>


@endsection
