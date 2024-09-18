@extends('components.admin-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Class Edit</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item">Class</li>
                            <li class="breadcrumb-item active">Edit</li>
                            <li><a href="#" id="delete_action" class="btn btn-danger btn-icon float-right mobile_menu2"><i class="zmdi zmdi-delete"></i></a></li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        <input type="hidden" name="delete_type" value="class">
                        <input type="hidden" name="delete_id" value="{{ $class->id }}">
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Edit</strong> Class</h2>
                            </div>
                            <form id="edit_class" method="post">
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $class->id }}">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $class->class_name }}" placeholder="Class Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="4" name="descr" class="form-control no-resize" placeholder=" Class Description"> {{ $class->descr }}</textarea>
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
        </div>
    </section>
@endsection
