@extends('components.admin-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Profile Edit</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item">Profile</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        <a href="profile.html" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-check"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Security</strong> Settings</h2>
                            </div>
                            <form id="edit_sec" method="post">
                                <div class="body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control"
                                                    value="{{ $admin->username }}" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="password" name="old_psw" class="form-control"
                                                    placeholder="Current Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="password" name="psw" class="form-control"
                                                    placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-info">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="card">
                            <div class="header">
                                <h2><strong>Account</strong> Settings</h2>
                            </div>
                            <form id="edit_admin" method="post">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $admin->name }}" placeholder="Names">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $admin->email }}" placeholder="E-mail">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
