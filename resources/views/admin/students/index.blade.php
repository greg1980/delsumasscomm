@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <h3><strong>Note: None departmental core and elective courses would not appear on the table below</strong></h3>
                    <p>Please ensure you carry out your course registration with other department and faculty as normal.</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Mass-Comm Department: <span class="badge badge-info">{{Auth::user() ? Auth::user()->level->name : ''}}</span> Level Courses</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Current Semesters Courses Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover  table-striped" id="users-table" width="100%" cellspacing="0">
                                    <thead class=" text-primary text-bold">
                                    <tr>
                                        <th>Semesters</th>
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
                                        <th>Semester</th>
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
                                       @foreach($user->courses->sortBy('name') as $course)
                                          @if (Auth::user()->level_id === $course->level_id && Auth::user()->semesters == $course->semesters  )
                                                <tr>
                                                    <td scope="row">{{$course->semesters === 0 ? 'First' : 'Second'}}</td>
                                                    <td><a href="">{{$course->course_name}}</a></td>
                                                    <td><span class="badge badge-primary">{{ $course->course_code ? $course->course_code : 'None'}}</span></td>
                                                    <td>
                                                        <span class="badge badge-danger">{{$course->credit_unit}}</span>
                                                        Unit
                                                        <span class="badge {{$course->choices == 0 ? 'badge-success' : 'badge-danger'}}">
                                                              {{$course->choices == 1 ? 'Elective' :'Core' }}
                                                        </span>
                                                    </td>
                                                    <td><span class="badge badge-info">{{$user->name}}</span></td>
                                                    <td><span class="badge badge-danger">{{$course->level->name}}</span> Level</td>
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
                            </div>
                        </div>
                    </div>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            @if (auth()->user()->level_id)
                                <h3>Note: To register hold down Ctrl on your keyboard and click on the course you intend to register </h3>
                                <p> Students are expected to choose at least one Departmental elective course and one Faculty course from the Faculty among those listed below the table:</p>
                            @endif
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                @include('includes.alerts')
                        </div>
                        <div v-show="true">
                            <form action="/elective" method="POST" enctype="multipart/form-data" class="">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-sm-1 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select name="course_id[]" class="form-select col-sm-8 form-control selectpicker {{$errors->has('course_id') ? 'is-invalid' : ''}}" size="6" multiple aria-label="multiple select example">
                                            @foreach ($registerCourses as $course)
                                                @if (Auth::user()->level_id === $course->level_id && Auth::user()->semesters === $course->semesters)
                                                        <option  value="{{$course->id}}">{{$course->course_name}} {{$course->course_code}}
                                                            <span class="badge {!! $course->choices == 0 ? 'badge-primary' : 'badge-danger' !!}">
                                                  {{$course->choices == 1 ? 'E' :'C' }}
                                            </span></option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('course_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($registered)
                                    <button type="submit" class="btn btn-sm btn-primary" {{$registered ? 'disabled' : ''}}>Registered</button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-primary" >Register</button>
                                @endif
                            </form>
                        </div>


                </div>
            </div>
        </div>
    </div>
@endsection
