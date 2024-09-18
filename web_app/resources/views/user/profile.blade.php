@extends('components.user-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Profile</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Hidden
                                    Facts</a></li>
                            <li class="breadcrumb-item"><a href="#">Profile</a></a></li>
                            <li class="breadcrumb-item active">Welcome to your profile {{ $user->first_name }}</li>
                            <li><a href="{{ route('user.edit', $user->username) }}" class="btn btn-info btn-icon float-right mobile_menu2"><i
                                class="zmdi zmdi-edit"></i></a></li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="card mcard_3">
                            <div class="body">
                                <a href="#">@if(!empty($user->profile_image))<img src="{{ url('/'.$user->profile_image) }}"
                                    class="rounded-circle shadow " alt="profile-image">
                                @else
                                <img src="{{ url('/assets/img/noimg.jpg') }}"
                                        class="rounded-circle shadow " alt="no-image">
                                @endif
                                </a>
                                <h4 class="m-t-10">{{ $user->first_name.' '.$user->last_name }}</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-muted">{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="body">
                                <small class="text-muted">Email address: </small>
                                <p>{{ $user->email }}</p>
                                <hr>
                                <small class="text-muted">Phone: </small>
                                <p>{{ $user->tel }}</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
