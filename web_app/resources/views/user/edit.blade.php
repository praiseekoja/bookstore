@extends('components.user-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Profile Edit</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Hidden Facts</a></li>
                            <li class="breadcrumb-item">Profile</li>
                            <li class="breadcrumb-item active">Edit</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Security</strong> Settings</h2>
                            </div>
                            <form id="edit_user_sec" method="post">
                                @method('PATCH')
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="password" name="old_psw" class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="password" name="psw" class="form-control" placeholder="New Password">
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
                            <form id="edit_userr" method="post">
                                @method('PATCH')
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="first_name" required value="{{ $user->first_name }}" class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="last_name" required value="{{ $user->last_name }}" class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="username" value="{{ $user->username }}" class="form-control" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="email" required value="{{ $user->email }}" class="form-control" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="tel" name="tel" value="{{ $user->tel }}" class="form-control" placeholder="Mobile Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea rows="4" name="addr" class="form-control no-resize" placeholder="Address Line 1">{{ $user->address }}</textarea>
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
