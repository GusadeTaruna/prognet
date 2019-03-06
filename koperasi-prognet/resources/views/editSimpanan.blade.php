@extends('layout.app')

@section('judul','Edit Simpanan')

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            @foreach ($simpanan as $simpan)
            <form method="post" action="/simpanan/{{$simpan->id}}" role="form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
              <div class="card">
                <div class="card-header card-header-primary">
                  <p class="card-category">Isi data dibawah</p>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-12">
                      <div class="form-group">
                        <select name="id_anggota" class="custom-select">
                              <option value="{{$simpan->anggota_id}}">{{$simpan->anggota_id}}</option>
                          </select>
                      </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="jenis" class="custom-select" id="inputGroupSelect01">
                          @if ($simpan->jenis_transaksi == 1)
                                    <option disabled>Jenis Transaksi</option>
                                    <option value="{{ $simpan->jenis_transaksi }}" selected>Simpanan</option>
                                    <option value="2">Penarikan</option>
                                @else @if ($simpan->jenis_transaksi == 2)
                                    <option disabled>Jenis Transaksi</option>
                                    <option value="1">Simpanan</option>
                                    <option value="{{ $simpan->jenis_transaksi }}" selected>Penarikan</option>
                                @else
                                    <option disabled selected>Jenis Transaksi</option>
                                    <option value="1" selected>Simpanan</option>
                                    <option value="2">Penarikan</option>
                                @endif
                                @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nominal Transaksi</label>
                          <input name="nominal" value="{{$simpan->nominal_transaksi}}" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    @endforeach
                      <input type="date" name="tgl" value="{{$simpan->tanggal}}" hidden id="theDate">
                      <input name="admin" hidden value="{{Auth::user()->id}}" />
                      <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-left">SIMPAN</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;       
        document.getElementById("theDate").value = today;
      </script>
      

  @endsection
