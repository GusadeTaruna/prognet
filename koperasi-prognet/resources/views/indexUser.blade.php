@extends('layout.app')

@section('judul','Data Karyawan')

@section('content')

        <div class="page-wrapper">
            <div class="row page-titles">
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title">Data Karyawan</h4>
                                </div>
                                <div class="col-6">
                                @if (Auth::user()->user_role==3)
                                   <a href="tambahkaryawan"><button type="button" class="btn btn-primary" style="float: right;">Tambah Karyawan</button></a>
                                @else
                                @endif
                                </div>
                            </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>ID User</th>
                                            <th>NIK</th>
                                            <th>Nama User</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                            @if (Auth::user()->user_role==3)
                                            <th>Aksi</th>
                                            @else
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($dataUser as $d)
                                            <td>{{$d->id}}</td>
                                            <td>{{$d->nik}}</td>
                                            <td>{{$d->nama}}</td>    
                                            <td>
                                                @if ($d->user_role == 1)
                                                    {{'Pengelola Simpanan'}}
                                                @else @if ($d->user_role == 2)
                                                    {{'Pengelola Pinjaman'}}
                                                @else @if ($d->user_role == 3)
                                                    {{'Admin'}}
                                                @endif
                                                @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->status_aktif == 1)
                                                    {{'Aktif'}}
                                                @else @if ($d->status_aktif == 0)
                                                    {{'Non-aktif'}}
                                                @endif
                                                @endif
                                            </td>
                                             @if (Auth::user()->user_role==3)
                                            <td style="width: 10%">
                                                @if ($d->status_aktif==1)
                                                <form style="float:left" action="user/{{$d->id}}/" method="GET">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-success" style="padding:3px" type="submit"><i class="fa fa-eye fa-fw"></i></button>
                                                </form>
                                                <form style="float: left;" action="user/{{$d->id}}/edit" method="GET">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-primary" style="padding:3px" type="submit" title="Edit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                                </form>
                                                <form style="float:left" action="usernon/{{$d->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="aktif()" class="btn btn-danger" style="padding: 3px" type="submit" title="Nonaktif" name="delete"><i class="fa fa-times fa-fw"></i></button>
                                                </form>

                                                @elseif ($d->status_aktif==0)
                                                <form style="float:left;" action="useraktif/{{$d->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <button onclick="nonaktif()" class="btn btn-danger" style="padding: 3px" type="submit" title="Aktif" name="delete"><i class="fa fa-check fa-fw"></i></button>
                                                </form>
                                                @endif
                                            @else

                                            </td>
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
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                <script>
                    function nonaktif(){  
                         Swal({
                              position: 'center',
                              type: 'success',
                              title: 'Karyawan berhasil diaktifkan',
                              showConfirmButton: false,
                              timer: 1500
                            });                                                       
                    }
                </script>
                <script>
                    function aktif(){  
                         Swal({
                              position: 'center',
                              type: 'success',
                              title: 'Karyawan berhasil dinonaktifkan',
                              showConfirmButton: false,
                              timer: 1500
                            });                                                       
                    }
                </script>
@endsection
