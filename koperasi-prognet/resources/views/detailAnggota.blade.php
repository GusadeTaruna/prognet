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
                                <h4>Data Nasabah</h4><br>
                                @foreach ($anggota as $a)
                                  <label>No Nasabah : {{$a->no_anggota}}</label><br>
                                  <label>Nama Nasabah : {{$a->nama}}</label><br>
                                  <label>Alamat : {{$a->alamat}}</label><br>
                                  <label>No. Telepon : {{$a->telepon}}</label><br>
                                  <label>No. KTP : {{$a->noktp}}</label><br>
                                  @if ($a->kelamin_id == 1)
                                    <label>Jenis Kelamin : Laki-laki</label><br>
                                  @elseif ($a->kelamin_id == 2)
                                    <label>Jenis Kelamin : Perempuan</label><br>
                                  @endif
                                  @if ($a->status_aktif == 1)
                                    <label>Status Aktif : Nasabah Aktif</label><br>
                                  @elseif ($a->kelamin_id == 2)
                                    <label>Status AKtif : Nasabah Non-Aktif</label><br>
                                  @endif
                                    <label>Total Saldo : Rp.{{ number_format($cekSaldo->saldo,'0', ',' , '.')}}</label><br>
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
                                        <h4 class="card-title">Riwayat Transaksi</h4>
                                    </div>
                                </div>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                  <th>No.</th>
                                                  <th>Tanggal</th>
                                                  <th>Debit</th>
                                                  <th>Kredit</th>
                                                  <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($transaksi as $t)
                                                <td align="center">{{$loop->iteration}}</td>
                                                <td>{{$t->tanggal}}</td>
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
