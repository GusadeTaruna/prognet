@extends('layout.app')

@section('judul','Buat Simpanan')

@section('content')

        <section role="main" class="content-body">
          <header class="page-header">
            <h2>Form Validation</h2>
          </header>

    <div class="row">
            <div class="col-md-12">
            <form method="post" action="/simpanan" role="form">
            {{ csrf_field() }}

        @if (count($name) > 0)
            @foreach ($name as $data)
                {{ $data->no_anggota }}<br>
                {{ $data->nama }}<br>
                {{ $data->alamat }}<br>
                {{ $data->telepon }}<br>
                {{ $data->noktp }}<br>
            @endforeach
        @else 
        Data tidak ditemukan.
        @endif


              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="jenis" class="custom-select" id="inputGroupSelect01">
                            <option selected disabled>Jenis Transaksi</option>
                              <option value="1">Simpanan</option>
                              <option value="2">Penarikan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nominal Transaksi</label>
                          <input name="nominal" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="bmd-label-floating">Anggota</label>
                          <input name="id_anggota" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                      <input type="date" name="tgl" hidden id="theDate">
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
