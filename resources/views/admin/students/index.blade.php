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
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Mass-Comm Department: <span class="badge badge-info">{{Auth::user() ? Auth::user()->level->name : ''}}</span> Level Courses</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @if (Session::has('message'))
                        <div  class="balert balert-success ">
                            <h4 class="mt-5 mb-5 ml-5">
                                <span><i class="fas fa-check-circle"></i></span>
                                {{ Session::get('message') }}
                            </h4>
                        </div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Current Semesters Courses Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                    <thead class=" text-primary text-bold">
                                    <tr>
                                        <th>Id</th>
                                        <th>course Name</th>
                                        <th>Code</th>
                                        <th>Credit Unit</th>
                                        <th>Assigned To</th>
                                        <th>Level name</th>
                                        <th>Registered</th>
                                    </tr>
                                    </thead>
                                    <tfoot class="text-primary text-bold">
                                    <tr>
                                        <th>Id</th>
                                        <th>course Name</th>
                                        <th>Code</th>
                                        <th>Credit Unit</th>
                                        <th>Assigned To</th>
                                        <th>Level name</th>
                                        <th>Registered</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($users as $user)
                                       @foreach($user->courses->sortBy('id') as $course)
                                          @if (Auth::user()->level_id === $course->level_id)
                                                <tr>
                                                    <th scope="row">{{$course->id}}</th>
                                                    <td><a href="">{{$course->course_name}}</a></td>
                                                    <td><span class="badge badge-primary">{{ $course->course_code ? $course->course_code  : 'None'}}</span></td>
                                                    <td><span class="badge badge-danger">{{$course->credit_unit}}</span> Unit</td>
                                                    <td><span class="badge badge-info">{{$user->name}}</span></td>
                                                    <td><span class="badge badge-danger">{{$course->level->name}}</span>  Level</td>
                                                    <td>
                                                       <span>
                                                            @foreach ($course->enrollments as $enrollment)
                                                           <i class="{{$enrollment->user_id === Auth::user()->id && Auth::user()->level_id === $enrollment->level_id ? 'far fa-check-circle text-success' : ''}} "></i></span>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                          @endif
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>

                                    <form action="/enrollment" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="enrolled" class="">
                                            <input type="hidden" name="courses" value="courses">
                                        </label>

                                        @if ($enrollment->user_id === Auth::user()->id && Auth::user()->level_id === $enrollment->level_id)
                                            <button type="submit" class="btn btn-sm btn-primary" {{$enrollment ? 'disabled' : ''}}>Registered</button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-primary" >Register</button>
                                        @endif
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
