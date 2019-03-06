@extends('layout.app')

@section('judul','Hitung Bunga')

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
                                <form id="form" method="post" action="/hitung" class="form-horizontal">
                                  {{ csrf_field() }}
                                  <h3 class="card-title" style="text-align: center;">Hitung Bunga Simpanan</h3>
                                  @php
                                    $monthNum  = date('m');
                                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                    $monthName = $dateObj->format('F'); 
                                  @endphp
                                    <h4 class="col-sm-12 control-label" style="text-align: center;">Bulan : {{$monthName}}</h4>
                                    <h4 class="col-sm-12 control-label" style="text-align: center;">Tahun : {{$tahunNow}}</h4>
                                    <h4 class="col-sm-12 control-label" style="text-align: center;">Persentase :
                                        @foreach ($dataMasterBunga as $d)
                                         {{$d->persentase." %"}}
                                        @endforeach
                                    </h4>
                                    <h4 class="col-sm-12 control-label" style="text-align: center;">
                                      @foreach ($cekTransaksiBulan as $d)
                                        @if ($d->total > 0)
                                          {{'Perhitungan Bunga Sudah Dilakukan Pada Bulan Ini'}}
                                        @else
                                          {{'Perhitungan Bunga Belum Dilakukan Pada Bulan Ini'}}
                                        @endif
                                      @endforeach
                                    </h4>
                                    <input name="status" hidden value="1" />
                                    <input name="id_user" hidden value="{{Auth::user()->id}}" />
                                    <footer class="panel-footer">
                                    <br>
                                      <div class="row">
                                        <div class="col-sm-12 col-sm-offset-3" style="text-align: center;">
                                            @foreach ($cekTransaksiBulan as $d) 
                                              @if ($d->total > 0)
                                                <button type="submit" disabled class="btn btn-primary">Hitung Bunga</button>;
                                              @else
                                                <button type="submit" class="btn btn-primary">Hitung Bunga</button>;
                                              @endif
                                            @endforeach
                                        </div>
                                      </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
      

  @endsection
