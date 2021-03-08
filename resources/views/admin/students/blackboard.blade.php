@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Students Blackboard For <span class="badge badge-info">{{Auth::user() ? Auth::user()->level->name : ''}}</span> Level </h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                   @include('includes.alerts')

                    <div class="row">
                        <div class="card-group">
                            @foreach($notes as $note)
                                @if (auth()->user()->level_id === $note->level_id && $note->deleted_at === null)
                            <div class="card mr-3" style="width: 300px">
                                <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22259%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20259%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_177d96bca99%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_177d96bca99%22%3E%3Crect%20width%3D%22259%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.25%22%20y%3D%2296%22%3E259x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
                                <div class="card-body">
                                    <h5 class="card-title"><b class="text-black-50">{{$note->title}}</b> </h5>
                                    <p><small>Created {{\Carbon\Carbon::parse($note->created_at)->diffForHumans() }} <i class="far fa-clock text-danger"></i></small></p>
                                    <h6 class="card-title">{{$note->course_code}}</h6>
                                    @if (!\App\Http\Controllers\StudentController::nowAvailableLecturer($note->created_at, $note->deadline))
                                        <a type="button" href="{{ route('admin.students.note', $note->id)}}" class="btn btn-primary">View</a>
                                    @else
                                        <button type="button" class="btn btn-primary" disabled>View</button>
                                    @endif
                                </div>
                                @if (!\App\Http\Controllers\StudentController::nowAvailableLecturer($note->created_at, $note->deadline))
                                    <div class="card-body mb text-success">Expires in {{$note->deadline > 1 ? "$note->deadline days" : "$note->deadline day"}}</div>
                                @else
                                    <div class="card-body mb text-warning">
                                        Assignment Expired <small><i class="far fa-clock text-danger"></i></small>
                                    </div>
                                @endif
                            </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
