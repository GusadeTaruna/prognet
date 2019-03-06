@extends('layout.app')

@section('judul','Report Mingguan')

@section('content')

        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <div class="container-fluid">
             <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">Report Nasabah</h4>
                                    </div>
                                </div>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Anggota</th>
                                                    <th>Nama Anggota</th>
                                                    <th>Saldo</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $no=1;
                                            @endphp
                                            @foreach($nasabah as $ta)
                                            <form action="#" method="post"  class="form-inline">
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$ta->no_anggota}}</td>
                                                <td>{{$ta->nama}}</td>
                                                <td>Rp. {{number_format($ta->saldo, '0', ',', '.')}}</td>
                                                <td>
                                                    <a href="report_nasabah/{{$ta->id}}" class="btn btn-info"><i class="fa fa-eye fa-fw"></i></button>
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
                </div>


      

  @endsection
