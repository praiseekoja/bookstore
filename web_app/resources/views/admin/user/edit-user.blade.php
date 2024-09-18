@extends('components.admin-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>User Edit</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active">Edit</li>
                            <li><a href="#" id="delete_action" class="btn btn-danger btn-icon float-right mobile_menu2"><i class="zmdi zmdi-delete"></i></a></li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        
                        <input type="hidden" name="delete_type" value="user">
                        <input type="hidden" name="delete_id" value="{{ $user->userId }}">
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12">
                        {{-- <div class="card">
                            <div class="header">
                                <h2><strong>Security</strong> Settings</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-info">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card">
                            <div class="header">
                                <h2><strong>Account</strong> Settings</h2>
                            </div>
                            <form id="edit_user" method="post">
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $user->userId }}">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="first_name" required class="form-control"
                                                    value="{{ $user->first_name }}" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="last_name" required class="form-control"
                                                    value="{{ $user->last_name }}" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="email" required class="form-control"
                                                    value="{{ $user->email }}" placeholder="E-mail">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="username" required class="form-control"
                                                    value="{{ $user->username }}" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ $user->tel }}" placeholder="Phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="address" rows="4" class="form-control no-resize" placeholder="Address Line 1">{{ $user->address }}</textarea>
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
