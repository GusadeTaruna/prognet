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
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-body">
                                  <form action="/simpanan" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                      <label>Masukkan No Anggota</label>
                                      <input type="text" class="form-control" name="idanggota" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lihat</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

  @endsection
