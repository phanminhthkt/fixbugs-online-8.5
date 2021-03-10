@extends('backend.layouts.index')
@section('content')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Minton</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome !</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <div class="float-left" dir="ltr">
                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#1abc9c" data-bgcolor="#d1f2eb" value="58" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                    </div>
                    <div class="text-right">
                        <h3 class="mb-1"> 268 </h3>
                        <p class="text-muted mb-1">New Customers</p>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <div class="float-left" dir="ltr">
                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#3bafda" data-bgcolor="#d8eff8" value="80" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                    </div>
                    <div class="text-right">
                        <h3 class="mb-1"> 8715 </h3>
                        <p class="text-muted mb-1">Online Orders</p>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <div class="float-left" dir="ltr">
                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#f672a7" data-bgcolor="#fde3ed" value="77" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                    </div>
                    <div class="text-right">
                        <h3 class="mb-1"> $925.78 </h3>
                        <p class="text-muted mb-1">Revenue</p>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card-box">
                    <div class="float-left" dir="ltr">
                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#6c757d" data-bgcolor="#e2e3e5" value="35" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                    </div>
                    <div class="text-right">
                        <h3 class="mb-1"> $78.58 </h3>
                        <p class="text-muted mb-1">Daily Average</p>
                    </div>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card-box">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Download</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title">Total Revenue</h4>

                    <div class="mt-3 text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Desktop</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Laptop</span>
                        </p>

                        <div id="sparkline1" class="mt-3"></div>

                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4> $56,214</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success"></i> $840</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-down text-danger"></i> $7,845</h4>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->

            <div class="col-xl-4">
                <div class="card-box">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Download</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title">Yearly Sales Report</h4>

                    <div class="mt-3 text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Revenue</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-light"></i> Number of Sales</span>
                        </p>

                        <div id="sparkline2" class="text-center mt-3"></div>

                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4>$8712</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success"></i> $523</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-down text-danger"></i> $965</h4>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->

            <div class="col-xl-4">
                <div class="card-box">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Download</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title">Weekly Sales Report</h4>

                    <div class="mt-3 text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-secondary"></i> Direct</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Affilliate</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-light"></i> Sponsored</span>
                        </p>

                        <div id="sparkline3" class="text-center mt-3"></div>

                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4> $12,365</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-down text-danger"></i> $365</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-up text-success"></i> $8,501</h4>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->

        </div>
        <!-- end row -->

      

        
@endsection        
        <!-- end row -->