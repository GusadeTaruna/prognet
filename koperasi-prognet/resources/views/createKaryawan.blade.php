@extends('layout.app')

@section('judul','Buat Karyawan')

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
                        <form id="form" method="POST" action="/user" class="form-horizontal">
                      {{ csrf_field() }}
                          <h2 class="card-title">Input Data Karyawan</h2>
                          <p class="card-subtitle">
                            Masukan data karyawan pada form dibawah
                          </p>
                          </header>
                          <div class="panel-body">
                            <div class="form-group">
                              <label class="col-sm-3 control-label">NIK Karyawan<span class="required">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" required/>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Nama Karyawan<span class="required">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required/>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Username<span class="required">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username" required/>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Password<span class="required">*</span></label>
                              <div class="col-sm-9">
                                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required/>
                                </div>
                            </div>
                            <div class="form-group">
                               <select name="user_role" id="user_role" class="form-control bmd-label-floating">
                                  <option disabled selected>Role Karyawan</option>
                                    <option value="1">Pengelola Simpanan</option>
                                    <option value="2">Pengelola Pinjaman</option>
                                    <option value="3">Administrator</option>
                               </select>
                            </div>
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
                      url: "{{ url('/user') }}",                                                                          
                      method: 'post',                                                                                           
                      data: {                                                                                                   
                        nik: jQuery('#nik').val(),                                                                         
                        nama: jQuery('#nama').val(), 
                        username: jQuery('#username').val(), 
                        password: jQuery('#password').val(),                                                                   
                      },                                                                                                        
                      success: function(result){                                                                                
                        if(result.errors)                                                                                       
                        {                                                                                                       
                         alert("Lengkapi Inputan yang ada");                                                        
                        }
                        else{
                          Swal({
                            title: 'Yakin dengan data ini?',
                            html:
                            'NIK : '+result.nik+'<br>Nama : '+result.nama+'<br>Username : '+result.username+'<br>Paswword : '+result.password,
                            type: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya'
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
                                  url: "{{ url('/userinsert') }}",                                                                 
                                  method: 'post',                                                                                      
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
                                        'Data Karyawan Berhasil Ditambahkan.',
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
