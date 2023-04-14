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
                        <a href="{{route('addition.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of additions
                        </a>
                        <a href="{{route('addition.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <form action="{{route('addition.update',$addition->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        Title<br>
                                        <input type="text" name="title" value="{{$addition->title}}"
                                               class="form-control mb-2" required>
                                        @error('title')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Value<br>
                                        <input type="number" name="price" value="{{$addition->price}}"
                                               class="form-control mb-2" required min="0" step="0.01">
                                        @error('price')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        <button type="submit" class="btn btn-warning mt-3">Edit</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
