@extends('components.user-layout')

@section('content')
    <section class="content file_manager">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Images</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                            <li class="breadcrumb-item"><a href="file-dashboard.html">File Manager</a></li>
                            <li class="breadcrumb-item active">Images</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                        <button class="btn btn-success btn-icon float-right" type="button"><i
                                class="zmdi zmdi-upload"></i></button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <ul class="nav nav-tabs pl-0 pr-0">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#a2018">2018</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#b2019">2019</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#b2016">2016</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="a2018">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/1.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/2.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/11.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/10.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/3.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/4.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/5.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/8.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/9.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="b2019">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/6.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/7.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/4.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/5.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/8.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2019</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/11.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/10.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <button type="button"
                                                            class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="image">
                                                        <img src="assets/images/image-gallery/14.jpg" alt="img"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                        <small>Size: 2MB <span class="date">Dec 11, 2016</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
