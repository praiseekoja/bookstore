@extends('components.user-layout')

@section('content')
    <section class="content file_manager">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Library</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Hidden
                                    Facts</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></a></li>
                            <li class="breadcrumb-item active">Collections</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        {{-- <button class="btn btn-success btn-icon float-right" type="button"><i
                                class="zmdi zmdi-upload"></i></button> --}}
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card"></div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="a2018">
                                <div class="row clearfix">
                                    @if (count($books) <= 0)
                                        <h3>Your collection is empty</h3>
                                    @else

                                    @endif
                                    @foreach ($books as $book)
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="image">
                                                        <img src="{{ url('/' . $book->thumbnail) }}" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <a href="{{ route('user.read', $book->id) }}" target="_blank"><p class="m-b-5 text-muted">{{ $book->title }}</p></a>
                                                        {{-- <small>Size: 2MB <span class="date">Dec 11, 2019</span></small> --}}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
