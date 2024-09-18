@extends('components.admin-layout')

@section('content')
    <section class="content">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon user">
                            <div class="body">
                                <h6>Users</h6>
                                <h2>{{ $users }}</h2>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon book">
                            <div class="body">
                                <h6>Books</h6>
                                <h2>{{ $books }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon class">
                            <div class="body">
                                <h6>Classes</h6>
                                <h2>{{ $classes }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon book-sub">
                            <div class="body">
                                <h6>Subjects</h6>
                                <h2>{{ $subjects }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                @if (count($recentBooks))
                    <div class="content file_manager">
                        <div class="body_scroll">
                            <div class="container-fluid">
                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>Recent <strong>Books</strong></h2>
                                                <ul class="header-dropdown">
                                                    <li class="remove">
                                                        <a role="button" class="boxs-close"><i
                                                                class="zmdi zmdi-close"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-contet">
                                                <div class="tab-pane">
                                                    <div class="row clearfix">
                                                        @foreach ($recentBooks as $recentBook)
                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                <div class="card">
                                                                    <div class="file">
                                                                        <a href="javascript:void(0);">

                                                                            <div class="icon">
                                                                                <i class="zmdi zmdi-collection-pdf"></i>
                                                                            </div>
                                                                            <div class="file-name">
                                                                                <p class="m-b-5 text-muted">
                                                                                    {{ $recentBook->title }}</p>
                                                                                {{-- <small>Size: 3MB <span class="date text-muted">Aug
                                                                                    18, 2019</span></small> --}}
                                                                            </div>
                                                                        </a>
                                                                    </div>
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
                        </div>
                    </div>
                @endif


                @if (count($recentSubjects))
                    <div class="content file_manager">
                        <div class="body_scroll">
                            <div class="container-fluid">
                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>Recent <strong>Subjects</strong></h2>
                                                <ul class="header-dropdown">
                                                    <li class="remove">
                                                        <a role="button" class="boxs-close"><i
                                                                class="zmdi zmdi-close"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-contet">
                                                <div class="tab-pane">
                                                    <div class="row clearfix">
                                                        @foreach ($recentSubjects as $recentSubject)
                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                <div class="card">
                                                                    <div class="file">
                                                                        <a href="javascript:void(0);">

                                                                            <div class="icon">
                                                                                <i
                                                                                    class="zmdi zmdi-collection-bookmark"></i>
                                                                            </div>
                                                                            <div class="file-name">
                                                                                <p class="m-b-5 text-muted">
                                                                                    {{ $recentSubject->subject_name }}</p>
                                                                                {{-- <small>Size: 3MB <span class="date text-muted">Aug
                                                                                    18, 2019</span></small> --}}
                                                                            </div>
                                                                        </a>
                                                                    </div>
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
                        </div>
                    </div>
                @endif


                @if (count($recentTrans))
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Recent <strong>Transactions</strong></h2>
                                    <ul class="header-dropdown">
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Transaction Date</th>
                                                    <th>Amount</th>
                                                    <th>Books #</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Books #</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($recentTrans as $recent)
                                                    <tr>
                                                        <td><a href="{{ route('trans.details', $recent->id) }}" target="_blank" rel="noopener noreferrer">{{ $recent->first_name . ' ' . $recent->last_name }}</a></td>
                                                        <td>{{ timeElapsed($recent->created_at) }}</td>
                                                        <td>₦{{ abbreviateNumber($recent->cost) }}</td>
                                                        <td>{{ count(json_decode($recent->details)) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </section>
@endsection
