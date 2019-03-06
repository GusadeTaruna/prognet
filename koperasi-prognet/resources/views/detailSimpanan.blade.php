@extends('layout.app')

@section('judul','Buat Simpanan')

@section('content')

              <div class="page-wrapper">
                <div class="row page-titles">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
                <div class="container-fluid">
                  <div class="col-lg-12 col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title ">Data Nasabah</h4>
                      </div>
                      <div class="card-body">
                        <form action="/simpanan" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="anggota_id" value="{{ $anggotaAktif->id }}">
                          <div class="tab-content">
                            <div class="tab-pane active" id="messages">               
                              <div style="width: 100%">
                                <h4 style="margin-bottom: 15px;margin-top: 10px;" >No. Anggota : {{$anggotaAktif->no_anggota}}</h4>
                                <h4 style="margin-bottom: 15px;" >Nama : {{$anggotaAktif->nama}}</h4>
                                <h4 style="margin-bottom: 15px;" >Alamat : {{$anggotaAktif->alamat}}</h4>
                                <h4 style="margin-bottom: 15px;" >Telepon : {{$anggotaAktif->telepon}}</h4>
                                <h4 style="margin-bottom: 15px;"> No. KTP : {{$anggotaAktif->noktp}}</h4>
                                <h4 style="margin-bottom: 15px;" >
                                Jenis Kelamin : @if ($anggotaAktif->kelamin_id == 1 )
                                      {{'Laki-laki'}}
                                  @elseif ($anggotaAktif->kelamin_id == 2 )
                                      {{'Perempuan'}}
                                  @endif
                                </h4>
                                <h4 style="margin-bottom: 15px;" >Pendaftar : {{$anggotaAktif->nama_user}}</h4>
                                <h4 style="margin-bottom: 15px;" >Saldo : {{'Rp.'.$cekSaldo->saldo}}</h4><br>
                              </div>
                            </div>
                          </div>
                        </form>
                        <div class="form-group">
                        <form action="simpanan" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="anggota_id" value="{{ $anggotaAktif->id }}">
                           <select name="jenis_transaksi" id="jenis_transaksi" class="form-control bmd-label-floating">
                              <option disabled selected>Jenis Transaksi</option>
                                <option value="1">Simpanan</option>
                                <option value="2">Penarikan</option>
                           </select>
                        </div>
                          @php
                            date_default_timezone_set('Asia/Makassar');
                            $date = date('Y-m-d H:i:s');
                          @endphp
                          <input type="hidden" name="tanggal" id="tanggal" value="@php echo $date; @endphp">
                          <div class="form-group">
                            <input type="number" class="form-control" name="nominal_transaksi" id="nominal_transaksi" placeholder="Nominal transaksi" required>
                          </div>
                          <input type="hidden" class="form-control" name="id_user" id="id_user" required value="{{ Auth::user()->id }}">
                          <button id="button-ajax" type="submit" class="btn btn-primary">Submit</button>
                          </form>
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
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th>Keterangan</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          @foreach ($dataSimpanan as $d)
                                              <td align="center">{{$loop->iteration}}</td>
                                              <td>{{$d->tanggal}}</td>
                                               @if ($d->tipe==1)
                                                    <td>
                                                      Rp. {{number_format($d->nominal_transaksi, '0', ',', '.')}}
                                                    </td>
                                                    <td>
                                                      {{'-'}}
                                                    </td>
                                                  @else
                                                    <td>
                                                      {{'-'}}
                                                    </td>
                                                    <td>
                                                      Rp. {{number_format($d->nominal_transaksi, '0', ',', '.')}}
                                                    </td>
                                                  @endif
                                              <td>{{$d->transaksi}}</td>
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
