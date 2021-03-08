@extends('layouts.admin')

@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid col-lg-12">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Create <small>course</small> </h1>
                    </div>
                    @include('includes.alerts')
                    @if ($errors->any())
                        <div class="palert palert-danger mt-5 mb-5">
                            <span><h4><i class="fas fa-exclamation-triangle mt-3 mb-4 ml-5"></i> Rectify the Following Errors </h4></span>
                            <ul class="ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card shadow mb-8 ">
                        <div class="card-header py-3 bg-primary col-lg-12">
                            <h6 class="m-0 font-weight-bold text-white "><span><i class="fas fa-user-plus"></i></span> Add New Course</h6>
                        </div>
                        <div class="card-body col-lg-12">
                            <form method="post" action="/storeCourse" class="px-6 py-3"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Course Title</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control col-sm-12 {{$errors->has('course_name') ? 'is-invalid' : ''}}"  name="course_name" value="{{ old('course_name') }}" {{Auth()->user()->role_id != 1 ? 'readonly' : ''}}>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Level</label>
                                    <div class="col-sm-8">
                                        <select class="form-control col-sm-6 {{$errors->has('level_id') ? 'is-invalid' : ''}}" name="level_id" id="">
                                            <option value="">select an option</option>
                                            @foreach ($levels as $level_id => $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Course Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('course_code') }}" class="form-control col-sm-6 {{$errors->has('course_code') ? 'is-invalid' : ''}}" name="course_code">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Semester</label>
                                    <div class="col-sm-8">
                                        <select name="semesters" id="" class="form-control col-sm-6 {{$errors->has('semesters') ? 'is-invalid' : ''}}">
                                            <option value="">select an option</option>
                                            <option value="0">First</option>
                                            <option value="1">Second</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select name="choices" id="" class="form-control col-sm-6 {{$errors->has('choices') ? 'is-invalid' : ''}}">
                                            <option value="">select an option</option>
                                            <option value="0">Core</option>
                                            <option value="1">Elective</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Credit Unit</label>
                                    <div class="col-sm-8">
                                        <input type="number" value="{{old('credit_unit')}}" class="form-control col-sm-6 {{$errors->has('credit_unit') ? 'is-invalid' : ''}}" name="credit_unit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Assign To</label>
                                    <div class="col-sm-8">
                                        <select name="user_id" id="" class="form-control col-sm-6 {{$errors->has('user_id') ? 'is-invalid' : ''}}">
                                            <option value="">select an option</option>
                                            <option value="0">Unknown</option>
                                            @foreach ($users as  $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
