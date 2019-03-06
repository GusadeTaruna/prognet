@extends('layout.app')

@section('judul','Edit Anggota')

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
                            @foreach ($karyawan as $k)
                                <form id="form" method="post" action="/karyawan-edit" class="form-horizontal">
                                  {{ csrf_field() }}
                                  <h2 class="card-title">Edit Data Karyawan</h2>
                                  <p class="card-subtitle">
                                    Masukan data anggota pada form dibawah
                                  </p>
                                  </header>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">NIK Karyawan <span class="required">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" name="nik" id="nik" class="form-control" value="{{$k->nik}}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Nama Karyawan <span class="required">*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" name="nama" id="nama" class="form-control" value="{{$k->nama}}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    @if ($k->user_role==1)
                                       <select name="user_role" id="user_role" class="form-control bmd-label-floating">
                                          <option disabled>Role Karyawan</option>
                                            <option value="1" selected>Pengelola Simpanan</option>
                                            <option value="2">Pengelola Pinjaman</option>
                                            <option value="3">Administrator</option>
                                       </select>
                                    @elseif ($k->user_role==2)
                                       <select name="user_role" id="user_role" class="form-control bmd-label-floating">
                                          <option disabled>Role Karyawan</option>
                                            <option value="1">Pengelola Simpanan</option>
                                            <option value="2" selected>Pengelola Pinjaman</option>
                                            <option value="3">Administrator</option>
                                       </select>
                                    @elseif ($k->user_role==3)
                                       <select name="user_role" id="user_role" class="form-control bmd-label-floating">
                                          <option disabled>Role Karyawan</option>
                                            <option value="1">Pengelola Simpanan</option>
                                            <option value="2">Pengelola Pinjaman</option>
                                            <option value="3" selected>Administrator</option>
                                       </select>
                                    @else
                                       <select name="user_role" id="user_role" class="form-control bmd-label-floating">
                                          <option disabled selected>Role Karyawan</option>
                                            <option value="1">Pengelola Simpanan</option>
                                            <option value="2">Pengelola Pinjaman</option>
                                            <option value="3">Administrator</option>
                                       </select>
                                    </div>
                                    @endif
                                      </div>
                                    </div>
                                    @endforeach
                                    <input hidden name="username" id="username" value="{{$k->username}}"></input>
                                    <input hidden name="password" id="password" value="{{$k->password}}"></input>
                                    <footer class="panel-footer">
                                      <div class="row">
                                        <div class="col-sm-9 col-sm-offset-3">
                                          <button id="button-ajax" class="btn btn-primary">Submit</button>
                                          <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                      </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                <script>
                jQuery(document).ready(function(){                                                                                 
                  jQuery('#button-ajax').click(function(e){                                                                        
                    e.preventDefault();                                                                                          
                    $.ajaxSetup({                                                                                                
                      headers: {                                                                                                
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                                          
                    }                                                                                                         
                    });                                                                                                           
                    jQuery.ajax({                                                                                                
                      url: "{{ url('/karyawan-edit') }}",                                                                          
                      method: 'post',                                                                                           
                      data: {                                                                                                   
                        nik: jQuery('#nik').val(),                                                                         
                        nama: jQuery('#nama').val(),
                        user_role: jQuery("select#user_role option:checked").val(),                                                               
                      },                                                                                                        
                      success: function(result){                                                                                
                        if(result.errors)                                                                                       
                        {                                                                                                       
                         alert("Lengkapi Inputan yang ada");                                                        
                        }
                        else{
                          Swal({
                            title: 'Are you sure?',
                            html:
                            'NIK : '+result.nik+'<br>Nama : '+result.nama+'<br>Role status : '+result.user_role,
                            type: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                          }).then((result) => 
                          {
                            if (result.value) {
                              jQuery(document).ready(function(){ 
                                e.preventDefault();                                                                                    
                                $.ajaxSetup({                                                                                          
                                  headers: {                                                                                          
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                                       
                                  }        
                                });       
                                jQuery.ajax({                                                                                          
                                  url: '{{url("user/{$k->id}")}}',                                                              
                                  type: 'put',                                                                                      
                                  data: {                                                                                           
                                    nik: jQuery('#nik').val(),                                                                       
                                    nama: jQuery('#nama').val(), 
                                    username: jQuery('#username').val(), 
                                    password: jQuery('#password').val(),
                                    user_role: jQuery("select#user_role option:checked").val(),
                                    status_aktif: 1,
                                  },                                                                                                   
                                  success: function(result){                                                        
                                    if(result.success == 'berhasil')                                                                      
                                    {    
                                      Swal(
                                        'Sukses!',
                                        'udah kesave.',
                                        'success'
                                      ) 
                                      window.location = "{{url('/user')}}";                                                       
                                    }
                                  }
                                })    
                              })
                            } 
                          })
                        }                                                                                                       
                      }                                                                                                      
                    })                                                                                                          
                  })
                })

              </script>
      

  @endsection
