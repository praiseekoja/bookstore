@extends('components.admin-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Book Edit</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item">Book</li>
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
                                <h2><strong>Edit</strong> Book</h2>
                            </div>
                            <form id="edit_book" method="post">
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $book->book_id }}">
                                <input type="hidden" name="old_prev_image" value="{{ $book->thumbnail }}">
                                <input type="hidden" name="old_docu" value="{{ $book->book_file }}">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="title" value="{{ $book->title }}" required placeholder="Book Title">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="number" name="price" class="form-control" required value="{{ $book->price }}" placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Thumbnail (Preview/cover image)</label>
                                            <input type="file" class="form-control" name="prev_image" accept="image/*" placeholder="Choose thumbnail">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Book File (PDF)</label>
                                            <input type="file" class="form-control" name="docu" accept=".pdf" placeholder="Choose Book File">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control no-resize" name="descr" required placeholder=" Book Description">{{ $book->descr }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <select rows="4" name="subject_id" class="form-control no-resize" required>
                                                <option value="Select Subject"></option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" @if ($book->subject_id == $subject->id)
                                                        @selected(true)
                                                    @endif>{{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <select rows="4" name="class_id" class="form-control no-resize" required>
                                                <option value="Select Class"></option>
                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" @if ($book->class_id == $class->id)
                                                    @selected(true)
                                                @endif>{{ $class->class_name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Save Changes</button>
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
