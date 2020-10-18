@extends('layouts.admin')

@section('content')

    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
                </div>
            </div>
            <div class="row">
                <!-- Column -->
                @if  (auth()->user()->id === $user->id || auth()->user()->role_id === 1 )
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-block">
                            <center class="p-4">
                                <img class="rounded-circle" width="150" src="{{$user->avatar ? asset('/storage/images/'. $user->avatar ) : '/storage/images/150.jpg' }}" alt="">
                                <h4 class="card-title m-t-10 mt-3 text-muted">{{ $user->role_id === 2 ? $user->title.' ' .$user->name : $user->name  }} </h4>
                                <h6 class="card-subtitle text-dark">Department of Mass-Comm</h6>
                                <div class="row text-center justify-content-md-center">
                                    <div class="col-4 mt-2"><a class="text-lg text-white"><span class="badge badge-info"><b>{{ $user->role ? $user->role->name : 'None'}}</b></span></a></div>
                                    @if($user->role_id === 3)
                                        <div class="col-4 mt-2"><a class="text-lg text-white "><span class="badge badge-danger">{{$user->level ? $user->level->name : ''}} Level</span></a></div>
                                        @endif
                                </div>
                            </center>
                            <center>
                                @if  (auth()->user()->id === $user->id)
                                <form method="post" action="/upload" enctype="multipart/form-data">
                                    <div class="form-group" >
                                        @csrf
                                        <input type="file" class="form-control-file ml-5 c" name="image" id="" placeholder=""
                                               aria-describedby="fileHelpId">
                                        <div class="form-group" >
                                             <small id="fileHelpId" class="form-text text-muted">update image</small>
                                        </div>

                                            <button class=" btn btn-primary btn-md" type="submit"><i class="far fa-id-card mr-2"></i> UPDATE</button>
                                    </div>
                                </form>
                                @endif
                            </center>

                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-6 col-xlg-9 col-md-7">
                    <form class="form-horizontal form-material" method="POST" action="/upload">
                        {{ method_field('PATCH') }}
                        @csrf
                    <div class="card mb-5 border-bottom-primary">
                        <div class="card-block">
                            <div class="card-header bg-primary text-white"><i class="fa fa-user mr-2"></i> Biodata</div>
                            <div class="form-group mt-3 ml-5">
                                <label  class="col-md-12"><b>TITLE :</b> {{ $user->title }} </label>
                            </div>

                            <div class="form-group ml-5">
                                <label class="col-md-12 "><b>FULL NAME :</b> {{$userdetails}} </label>
                            </div>

                            <div class="form-group ml-5">
                                <label class="col-md-12"><b>GENDER :</b> {{ $user->gender ? 'Female': 'Male' }}</label>
                            </div>
                            <div class="form-group ml-5">
                                <label class="col-md-12" ><b>DOB :</b><em style="filter: blur(3px);">{{ $user->dateofbirth ?  $user->dateofbirth : '-' }}</em></label>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-5 border-bottom-primary">
                        <div class="card-block">
                            <div class="card-header bg-primary text-white"><i class="far fa-address-card mr-2"></i> Contact</div>
                            <div class="form-group mt-3 ml-5">
                                <label class="col-md-12"><b>MOBILE :</b> {{ $user->mobile ?  $user->mobile : '-' }} </label>
                            </div>
                            <div class="form-group ml-5">
                                <label class="col-md-12"><b>EMAIL:</b> {{ $user->email }}</label>
                            </div>
                            <div class="form-group ml-5">
                                <label class="col-md-12"><b>HOUSE NUMBER :</b> {{ $user->housenumber ? $user->housenumber : '-' }}</label>
                            </div>
                            <div class="form-group ml-5">
                                <label class="col-md-12"><b>STREET :</b> {{ $user->address ? $user->address : '-'}}</label>
                            </div>
                            <div class="form-group ml-5">
                                <label class="col-md-12"><b>CITY :</b> {{ $user->city ? $user->city : '-'}}</label>
                            </div>

                        </div>
                    </div>

                        @if (auth()->user()->role->id === 3)
                        <div class="card mb-5 border-bottom-primary">
                            <div class="card-block">
                                <div class="card-header text-white bg-primary"><i class="fa fa-graduation-cap mr-2"></i> School Info</div>
                                <div class="form-group mt-3 ml-5">
                                    <label class="col-md-12"><b>MAT NUMBER :</b> {{ $user->matnumber ?  $user->matnumber  : '-' }} </label>
                                </div>
                                <div class="form-group ml-5">
                                    <label class="col-md-12"><b>YEAR OF ADMISSION : </b>{{ $user->yearofadmission ?  $user->yearofadmission  : '-' }}</label>
                                </div>
                                <div class="form-group ml-5">
                                    <label class="col-md-12"><b>YEAR OF GRADUATION :</b> {{ $user->yearofgrad ?  $user->yearofgrad : '-' }}</label>
                                </div>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
                @else
                     <div class="col-12 text-center mt-5">
                         <h1 class="mt-5"> <i class="fas fa-bug ml-5 text-warning"></i> This page does not exist </h1>
                     </div>
                @endif
                <div class="col-2">
                        <div class="form-group">
                            @if  (auth()->user()->id === $user->id)
                                <div class="col-sm-12">
                                    <a href="{{ route('admin.users.editprofile', $user->id) }}"><button class="btn btn-info " ><i class="fas fa-user-edit mr-2"></i> EDIT</button></a>
                                </div>
                            @endif

                        </div>
                </div>
            </div>

        </div>

    </div>
    @endsection
