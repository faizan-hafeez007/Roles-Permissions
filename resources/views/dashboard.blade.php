@extends('layouts.app')

@section('content')
  <div class="page-header bg-gradient-primary text-white p-4 rounded mb-4">
    <h3 class="page-title d-flex align-items-center">
      <span class="page-title-icon bg-white text-gradient-primary rounded-circle me-3">
        <i class="mdi mdi-home"></i>
      </span> Dashboard
    </h3>
    <p class="page-subtitle mb-0">Welcome to your dashboard</p>
  </div>
  
  <div class="row g-4">
    <div class="col-lg-3 col-md-6">
      <div class="card card-statistics shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <i class="mdi mdi-account text-primary fs-1 me-3"></i>
          <div>
            <h5 class="card-title">Users</h5>
            <h6 class="card-subtitle">Total Users: 100</h6>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
      <div class="card card-statistics shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <i class="mdi mdi-file-document text-success fs-1 me-3"></i>
          <div>
            <h5 class="card-title">Reports</h5>
            <h6 class="card-subtitle">Total Reports: 50</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card card-statistics shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <i class="mdi mdi-chart-line text-info fs-1 me-3"></i>
          <div>
            <h5 class="card-title">Sales</h5>
            <h6 class="card-subtitle">Total Sales: $1000</h6>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
      <div class="card card-statistics shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <i class="mdi mdi-email text-warning fs-1 me-3"></i>
          <div>
            <h5 class="card-title">Messages</h5>
            <h6 class="card-subtitle">Total Messages: 20</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
