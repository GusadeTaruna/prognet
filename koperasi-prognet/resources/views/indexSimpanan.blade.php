@extends('layout.app')

@section('judul','Data Simpanan')

@section('content')


        <div class="page-wrapper">
            <div class="row page-titles">
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
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
                                    <h4 class="card-title">Data Transaksi</h4>
                                </div>
                                <div class="col-6">
                                   <a href="/anggota/create"><button type="button" class="btn btn-primary" style="float: right;">Tambah Transaksi</button></a>
                                </div>
                            </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>ID Anggota</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Nominal Transaksi</th>
                                            <th>Yang Daftarin</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataSimpanan as $d)
                                            <td>{{$d->nomer}}</td>
                                            <td>{{$d->tanggal}}</td>   
                                            <td>
                                                @if ($d->jenis_transaksi == 1)
                                                    {{'Simpanan'}}
                                                @else @if ($d->jenis_transaksi == 2)
                                                    {{'Penarikan'}}
                                                @endif
                                                @endif
                                            </td>
                                            <td>{{$d->nominal_transaksi}}</td>
                                            <td>{{$d->nama_user}}</td>
                                            <td style="width: 12%">
                                            <form style="float:left;" action="simpanan/{{$d->id}}/edit" method="GET">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary" style="padding: 15px" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                            </form>
                                            <form style="float:right;" action="simpanan/{{$d->id}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" style="padding: 15px" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                            </form>
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
