@extends('layout.app')

@section('judul','Buat Persentase')

@section('content')

            <div class="page-wrapper">
                <div class="row page-titles">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
                <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @if (Auth::user()->user_role==3)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="form" method="post" action="/bunga" class="form-horizontal">
                                  {{ csrf_field() }}
                                    <h2 class="card-title">Tambah Persentase</h2>
                                    <p class="card-subtitle">
                                      Masukan data anggota pada form dibawah
                                    </p>
                                  </header>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Persentase (%)<span class="required">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" name="persen" class="form-control" required/>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Tanggal Berlaku <span class="required">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="date" name="berlaku" class="form-control" required/>
                                        </div>
                                  </div>
                                  <footer class="panel-footer">
                                    <div class="row">
                                      <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title">Data Master Bunga</h4>
                                        </div>
                                    </div>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                <th>Persentase (%)</th>
                                                <th>Tanggal Berlaku</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($dataMaster as $d)
                                                <td>{{$d->persentase}}</td>
                                                <td>{{$d->tanggal_mulai_berlaku}}</td>   
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
