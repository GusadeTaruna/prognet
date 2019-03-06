@extends('layout.app')

@section('judul','Dashboard')

@section('content')
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                        <div class="card-body" style="background-color: white;width: 25%">
                            <div class="row">
                                <div class="col-md-3">
                                    <h2 class="m-b-0"><i class="mdi mdi-account-multiple text-info"></i></h2>
                                    <h3 class="">{{$users}}</h3>
                                    <h6 class="card-subtitle">Nasabah</h6></div>
                            </div>
                        </div>
                    <!-- Column -->
                    <!-- Column -->
                </div>
                <!-- Row -->
          
@endsection
