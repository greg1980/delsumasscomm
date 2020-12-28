@extends('layouts.admin')


@section('content')


    <div id="wrapper" xmlns="http://www.w3.org/1999/html">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Total of <span class="badge badge-info"> {{ count($courses) }} </span> Courses</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                  <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Courses Table</h6>
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                <thead class=" text-primary text-bold">
                                <tr>

                                    <th>course Name</th>
                                    <th>Code</th>
                                    <th>Credit Unit</th>
                                    <th>Assigned To</th>
                                    <th>Level name</th>
                                    <th>Status</th>
                                    <th>Semesters</th>
                                </tr>
                                </thead>
                                <tfoot class="text-primary text-bold">
                                <tr>
                                    <th>course Name</th>
                                    <th>Code</th>
                                    <th>Credit Unit</th>
                                    <th>Assigned To</th>
                                    <th>Level Name</th>
                                    <th>Status</th>
                                    <th>Semesters</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach ($users as $user)
                                    @foreach($user->courses->sortBy('id') as $course)
                                        @if ($course->choices !=1)
                                            <tr>
                                                <td><a href="{{route('admin.users.editcourses', $course->id)}}">{{$course->course_name}}</a></td>
                                                <td><span class="badge badge-primary">{{ $course->course_code ? $course->course_code  : 'None'}}</span></td>
                                                <td><span class="badge badge-danger">{{$course->credit_unit}}</span> Unit</td>
                                                <td>{{$user->name}}</td>
                                                <td><span class="badge badge-danger">{{$course->level->name}}</span>  Level</td>
                                                <th scope="row">{{$course->choices == 1 ? 'Elective' :'Core' }}</th>
                                                <td><span><i class=""></i>{{ $course->semesters === 0 ? 'First' : 'second' }} </span></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                 @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Of Elective Courses </h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible ">

                            </div>
                            @foreach ($courses as $course)
                                @if ($course->user_id == 0 || ($course->choices == 1))
                                   <br> {{ $course->course_name}} {{$course->course_code}}
                                            <span class="badge {{$course->choices == 0 ? 'badge-primary' : 'badge-danger'}}">
                                                 {{$course->choices == 1 ? 'E' :'C' }}
                                            </span>
                                    </br>
                                  @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
