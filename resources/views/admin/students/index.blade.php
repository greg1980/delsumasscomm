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
                                    <th scope="col">Registered</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                   @foreach($user->courses as $course)
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
                                                       <i class="{{ Auth::user()->id !== $enrollment->user_id ? '' : 'far fa-check-circle text-success'}} "></i></span>
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
                                    @if (Auth::user()->id !== $enrollment->user_id)
                                        <button type="submit" class="btn btn-sm btn-primary">Register</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-primary" disabled>Registered</button>
                                    @endif

                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
