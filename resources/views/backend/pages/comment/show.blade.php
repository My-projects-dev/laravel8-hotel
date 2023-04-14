@extends('layouts.backend.master')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a href="{{route('comment.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of comments
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-4">
                                    <span class="text-primary">Name:</span> {{$user->name}} <br>
                                    <span class="text-primary">Email:</span> {{$user->email}} <br>
                                    <span class="text-primary">Subject:</span> {{$user->subject}} <br>
                                    <span class="text-primary">Comment:</span><br>
                                    <p class="mt-1">{{$user->comment}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
