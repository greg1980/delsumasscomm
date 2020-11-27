@extends('layouts.admin')


@section('content')
    @include('includes.tinyeditor')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
               @include('includes.lecdashboard')
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800"> <span class="badge badge-info">{{ Auth::user()->name }}</span> Blackboard <i class="fas fa-chalkboard-teacher ml-3"></i></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @include('includes.alerts')
                    <div class="row">
                        <div class="col-lg-6 col-xlg-9 col-md-7 ">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Post Your Notes and Assignment</h6>
                                </div>
                                    <div class="card-body">
                                        <form method="POST" action="/lecturer"  enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="font-weight-bold">Post Title:</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="title" placeholder="Introduction Notes">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1" class="font-weight-bold">Students Level:</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="level_id">
                                                    <option>select an option</option>
                                                    @foreach ($levels as $level_id => $level)
                                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2" class="font-weight-bold">Assigned Course:</label>
                                                <select class="form-control" id="exampleFormControlSelect2" name="course_code">
                                                    <option>select an option</option>
                                                    @foreach(auth()->user()->courses as $course)
                                                    <option>{{$course->course_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1" class="font-weight-bold">Textarea:</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="description"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-primary mb-2">Post Notes</button>
                                        </form>
                                    </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xlg-3 col-md-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Notes / Assignments</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                                <thead class=" text-primary text-bold">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Code</th>
                                                    <th>Level name</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lecturers as $lecturer )
                                                    @if (auth()->user()->id === $lecturer->user_id)
                                                    <tr>
                                                        <td><a href="#">{{$lecturer->Title}}</a></td>
                                                        <td><span class="badge badge-info">{{$lecturer->course_code}}</span></td>
                                                        <td>{{$lecturer->created_at}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
