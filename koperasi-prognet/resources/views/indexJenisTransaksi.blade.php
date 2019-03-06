@extends('layout.app')

@section('judul','Data Anggota')

@section('content')

        <div class="page-wrapper">
            <div class="row page-titles">
                <div>
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
                                    <h4 class="card-title">Jenis Transaksi</h4>
                                </div>
                                <div class="col-6">
                                @if (Auth::user()->user_role==3)
                                   <a href="/anggota/create"><button type="button" class="btn btn-primary" style="float: right;">Tambah Jenis</button></a>
                                @else
                                @endif
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Transaksi</th>
                                        <th>Tipe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jenis as $d)
                                        <td align="center">{{$loop->iteration}}</td>
                                        <td>{{$d->transaksi}}</td>
                                        <td>
                                            @if ($d->tipe==1)
                                                {{'Debit'}}
                                            @elseif ($d->tipe==-1)
                                                {{'Kredit'}}
                                            @endif
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
