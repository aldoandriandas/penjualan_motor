@extends('admin.layouts.app')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tachometer-alt mr-2"></i>
        Dashboard Motor
    </h1>

    <div class="row">
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Penghasilan (Tahunan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Penghasilan (Bulanan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penghasilan (Harian)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAdmin ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Chart --}}
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Activity -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history mr-2"></i> Log Activity
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Filter Activity:</div>
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Last 7 Days</a>
                            <a class="dropdown-item" href="#">Last 30 Days</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Export Logs</a>
                            <a class="dropdown-item" href="#">Clear All</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body - Log Activity List -->
                <div class="card-body p-0">
                    <div class="activity-list" style="max-height: 320px; overflow-y: auto;">
                        <!-- Activity Item 1 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-success-light rounded-circle p-2" style="background-color: #e8f5e9;">
                                    <i class="fas fa-user-plus text-success" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">User Registration</h6>
                                    <small class="text-muted">2 min ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">John Doe registered as a new member</p>
                            </div>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-info-light rounded-circle p-2" style="background-color: #e3f2fd;">
                                    <i class="fas fa-shopping-cart text-info" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">New Order</h6>
                                    <small class="text-muted">15 min ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">Order #INV-2025-001 created - $299.00</p>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-warning-light rounded-circle p-2" style="background-color: #fff3e0;">
                                    <i class="fas fa-edit text-warning" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">Profile Updated</h6>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">Jane Smith updated her profile information</p>
                            </div>
                        </div>

                        <!-- Activity Item 4 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-danger-light rounded-circle p-2" style="background-color: #ffebee;">
                                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">System Alert</h6>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">High traffic detected on the server</p>
                            </div>
                        </div>

                        <!-- Activity Item 5 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-primary-light rounded-circle p-2" style="background-color: #e8eaf6;">
                                    <i class="fas fa-chart-line text-primary" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">Report Generated</h6>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">Monthly sales report generated</p>
                            </div>
                        </div>

                        <!-- Activity Item 6 -->
                        <div class="d-flex align-items-start p-3 border-bottom hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                <div class="bg-secondary-light rounded-circle p-2" style="background-color: #f5f5f5;">
                                    <i class="fas fa-download text-secondary" style="font-size: 14px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 font-weight-bold text-gray-800">Export Data</h6>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                                <p class="mb-0 text-sm text-gray-600">Admin exported user data to CSV</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer - View All Link -->
                <div class="card-footer bg-white text-center py-2">
                    <a href="#" class="text-primary small font-weight-bold text-decoration-none">
                        View All Activities <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
