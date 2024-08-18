@extends('components.user-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Watchlist</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Hidden Facts</a></li>
                            <li class="breadcrumb-item">WatchList</li>
                            <li class="breadcrumb-item active">Saved Items</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover product_item_list c_table theme-color mb-0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Book Title</th>
                                            <th data-breakpoints="sm xs">Class</th>
                                            <th data-breakpoints="xs">Subject</th>
                                            <th data-breakpoints="xs md">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($items) > 0)
                                            @foreach ($items as $item)
                                            <tr>
                                                <td><img src="{{ url('/'.$item->thumbnail) }}" width="48"
                                                        alt="Book img">
                                                </td>
                                                <td>
                                                    <h5>{{ $item->thumbnail }}</h5>
                                                </td>
                                                <td><span class="text-muted">{{ $item->subject_name }}</span>
                                                </td>
                                                <td>{{ $item->class_name }}</td>
                                                <td><span>₦{{ abbreviateBalance($item->price) }}</span></td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <h2>Watchlist is empty.</h2>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
