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
                                <form action="/report_mingguan" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                      <label  class="bmd-label-floating">Minggu Transaksi</label>
                                       <input type="week" class="form-control" name="pilih_tanggal" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              @if(!empty($mingguan))
             <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">Data Transaksi</h4>
                                    </div>
                                </div>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           @php
                                                $no=1;
                                            @endphp
                                            @foreach($mingguan as $data)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$data->tanggal}}</td>
                                                <td>{{$data->transaksi}}</td>
                                                @if ($data->jenis_transaksi == 1 || $data->jenis_transaksi == 3)
                                                    <td>Rp. {{ $data->total }}</td>
                                                    <td>-</td>
                                                @else
                                                    <td>-</td>
                                                    <td>Rp. {{ $data->total }}</td>
                                                @endif
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

                @else

                @endif

      

  @endsection
