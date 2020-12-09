@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('includes.lecdashboard')
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-5 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800"> <span class="badge badge-info">{{ Auth::user()->name }}</span> Assigned courses <i class="fas fa-book ml-2"></i>  </h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <div class="alert alert-primary mb-5 mt-5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                         <h1>You have been assigned a total of <span class="badge badge-pill badge-primary">{{count(auth()->user()->courses)}}</span> courses. </h1>
                        <p>Toggle through the course title to see if the course contents matches what you intend to deliver before the end of the semester</p>
                         <p>so that the students would be aware of what they should expect </p>
                    </div>
                       @include('includes.alerts')
                    @if( count(auth()->user()->courses) )
                        @foreach( auth()->user()->courses as $course )
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="#headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn  btn-link btn-block text-left text-black-50" type="button" data-toggle="collapse" data-target="#collapseOne{{ $course->id }}" aria-expanded="true" aria-controls="collapseOne">
                                                <b>{{ $course->course_name }} </b> <b><span class="badge badge-danger ml-5"> {{ $course->course_code }}</span></b>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne{{ $course->id }}" class="collapse show} " aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                          <p class="ml-3">{{ $course->course_code }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
