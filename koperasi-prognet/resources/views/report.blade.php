@extends('layout.app')

@section('judul','Data Anggota')

@section('content')

                    <!-- start: page -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title">Report Transaksi</h4>
                                </div>
                            </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>No.Anggota</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sal as $d)
                                            <td>{{$d->nomer}}</td>
                                            <td>{{$d->nama}}</td>   
                                            <td>{{$d->tanggal}}</td>
                                            <td>
                                                @if($d->transaksi=="Penarikan") {{$d->nominal_transaksi}} @else {{""}}  @endif
                                            </td>
                                            <td>
                                               @if($d->transaksi=="Simpanan" || $d->transaksi=="Bunga" ) {{$d->nominal_transaksi}} @else {{""}} @endif
                                            </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
