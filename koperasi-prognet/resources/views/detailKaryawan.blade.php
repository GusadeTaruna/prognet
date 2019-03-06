@extends('layout.app')

@section('judul','Buat Anggota')

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
                                <h4>Data Karyawan</h4><br>
                                @foreach ($karyawan as $k)
                                  <label>NIK : {{$k->nik}}</label><br>
                                  <label>Nama Karyawan : {{$k->nama}}</label><br>
                                @if ($k->user_role == 1)
                                    <label>Role : Pengelola Simpanan</label><br>
                                @elseif ($k->user_role == 2)
                                    <label>Role : Pengelola Pinjaman</label><br>
                                @elseif ($k->user_role == 3)
                                    <label>Role : Administrator</label><br>
                                  @endif
                                  @if ($k->status_aktif == 1)
                                    <label>Status Aktif : Karyawan Aktif</label><br>
                                  @elseif ($k->kelamin_id == 0)
                                    <label>Status AKtif : Karyawan Non-Aktif</label><br>
                                  @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">Transaksi yang ditangani</h4>
                                    </div>
                                </div>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                  <th>No</th>
                                                  <th>Tanggal</th>
                                                  <th>Nasabah</th>
                                                  <th>Debit</th>
                                                  <th>Kredit</th>
                                                  <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($transaksi as $t)
                                                <td align="center">{{$loop->iteration}}</td>
                                                <td>{{$t->tanggal}}</td>
                                                <td>{{$t->nama}}</td>
                                                 @if ($t->jenis_transaksi == 1 || $t->jenis_transaksi == 3)
                                                    <td>Rp. {{ number_format($t->nominal_transaksi,'0', ',' , '.') }}</td>
                                                    <td>-</td>
                                                @else
                                                    <td>-</td>
                                                    <td>Rp. {{ number_format($t->nominal_transaksi,'0', ',' , '.') }}</td>
                                                @endif
                                                <td>
                                                    @if ($t->jenis_transaksi == 1)
                                                        Simpanan
                                                    @elseif ($t->jenis_transaksi == 2)
                                                        Penarikan
                                                    @elseif ($t->jenis_transaksi == 3)
                                                        Bunga Simpanan
                                                    @elseif ($t->jenis_transaksi == 4)
                                                        Pajak Simpanan
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
                </div>



  @endsection
