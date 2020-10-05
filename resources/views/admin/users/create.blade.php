@extends('layouts.admin')

@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid col-lg-8">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> create <small>users</small> </h1>
                    </div>
                    @if (Session::has('message'))

                        <div  class="balert balert-success ">
                            <h4 class="mt-5 mb-5 ml-5">
                                <span><i class="fas fa-check-circle"></i></span>
                                {{ Session::get('message') }}
                            </h4>
                        </div>
                    @endif
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
                            <h6 class="m-0 font-weight-bold text-white "><span><i class="fas fa-user-plus"></i></span> Add New Users</h6>
                        </div>
                        <div class="card-body col-lg-12">
                            <form method="post" action="/store" class="px-6 py-3"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control col-sm-10 {{$errors->has('name') ? 'is-invalid' : ''}}"  name="name" value="{{ old('name') }}" {{Auth()->user()->role_id != 1 ? 'readonly' : ''}}>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" value="{{ old('email') }}" class="form-control col-sm-10 {{$errors->has('email') ? 'is-invalid' : ''}}" name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" value="{{old('password')}}" class="form-control col-sm-10 {{$errors->has('password') ? 'is-invalid' : ''}}" name="password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select name="is_active" id="" class="form-control col-sm-10 {{$errors->has('is_active') ? 'is-invalid' : ''}}">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">User Role</label>
                                    <div class="col-sm-8 mb-5">
                                            <select class="form-control col-sm-10 {{$errors->has('role_id') ? 'is-invalid' : ''}}" name="role_id" id="">
                                                <option value="" >select an option</option>
                                                @foreach ($roles as  $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
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
