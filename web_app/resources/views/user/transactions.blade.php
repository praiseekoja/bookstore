@extends('components.user-layout')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Transaction List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Hidden
                                    Facts</a></li>
                            <li class="breadcrumb-item">Transactions</li>
                            <li class="breadcrumb-item active">Transaction List</li>
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
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Transactions</strong></h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Spent</th>
                                            <th>Books #</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Spent</th>
                                            <th>Books #</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($recentTrans as $recent)
                                            <tr>
                                                <td>{{ timeElapsed($recent->create_at) }}</td>
                                                <td>₦{{ abbreviateBalance($recent->cost) }}</td>
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
        </div>
    </section>
@endsection
