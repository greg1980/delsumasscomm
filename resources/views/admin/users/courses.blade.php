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
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Total of <span class="badge badge-info"> {{ count($courses) }} </span> Courses</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <div class="card-body">
                        <div class="card-header">
                            <table class="table table-striped">
                                <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">course Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Credit Unit</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Level name</th>
                                    <th scope="col">Semesters</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    @foreach($user->courses as $course)
                                            <tr>
                                                <th scope="row">{{$course->id}}</th>

                                                <td><a href="{{route('admin.users.editcourses', $course->id)}}">{{$course->course_name}}</a></td>
                                                <td><span class="badge badge-primary">{{ $course->course_code ? $course->course_code  : 'None'}}</span></td>
                                                <td><span class="badge badge-danger">{{$course->credit_unit}}</span> Unit</td>
                                                <td>{{$user->name}}</td>
                                                <td><span class="badge badge-danger">{{$course->level->name}}</span>  Level</td>
                                                <td><span><i class=""></i>{{ $course->semesters == 1 ? 'First' : 'second' }} </span></td>
                                            </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@stop
