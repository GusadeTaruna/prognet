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
                              <form id="form" method="post" action="/anggota" class="form-horizontal">
                              {{ csrf_field() }}
                              <h2 class="card-title">Input Data Anggota</h2>
                              <p class="card-subtitle">
                                Masukan data anggota pada form dibawah
                              </p>
                              </header>
                              <div class="panel-body">
                                <div class="form-group">
                                  @forelse ($anggota as $d)
                                        @php
                                            date_default_timezone_set('Asia/Makassar');
                                            $no = date('Y');
                                            $d=$d->id;
                                        @endphp
                                        @php
                                          $d=$d+1;
                                        @endphp
                                  @empty
                                        @php
                                            date_default_timezone_set('Asia/Makassar');
                                            $no = date('Y');
                                            $d=1;
                                        @endphp
                                  @endforelse
                                  <input type="text" name="no_anggota" id="no_anggota" value="@php echo $no;printf('%04u', $d); @endphp" class="form-control" hidden>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Nama <span class="required">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Alamat <span class="required">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">No. Telepon <span class="required">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" name="telp"  id="telepon" class="form-control" placeholder="Masukkan Nomer Telepon" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">No. KTP <span class="required">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" name="ktp"  id="noktp" class="form-control" placeholder="Masukkan Nomer KTP" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Jenis Kelamin</label>
                                  <div class="col-sm-9">
                                    <div class="radio-custom">
                                      <input type="radio" name="kelamin" value="1" id="radioExample1">
                                      <label for="radioExample1">Laki-Laki</label>
                                    </div>
                                    <div class="radio-custom">
                                      <input type="radio" name="kelamin" value="2" id="radioExample2">
                                      <label for="radioExample2">Perempuan</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <input name="admin" id="admin" hidden value="{{Auth::user()->id}}" />
                              <footer class="panel-footer">
                              <div class="row">
                                <div class="col-sm-9 col-sm-offset-3">
                                  <button id="button-ajax" type="submit" class="btn btn-primary">Submit</button>
                                  <button type="reset" class="btn btn-default">Reset</button>
                                </div>                   
                              </form>
                            </div>
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
                      url: "{{ url('/anggota') }}",                                                                          
                      method: 'post',                                                                                           
                      data: {                                                                                                   
                        nama: jQuery('#nama').val(),                                                                         
                        alamat: jQuery('#alamat').val(), 
                        telepon: jQuery('#telepon').val(), 
                        noktp: jQuery('#noktp').val(),                                                                   
                      },                                                                                                        
                      success: function(result){                                                                                
                        if(result.errors)                                                                                       
                        {                                                                                                       
                         alert("Lengkapi Inputan yang ada");                                                        
                        }
                        else{
                          Swal({
                            title: 'Yakin dengan data dibawah?',
                            html:
                            'Nama : '+result.nama+'<br>Alamat : '+result.alamat+'<br>No. Telepon : '+result.telepon+'<br>No. KTP : '+result.noktp,
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
                                  url: "{{ url('/testing-ajax') }}",                                                                 
                                  method: 'post',                                                                                      
                                  data: {                                                                                           
                                    nama: jQuery('#nama').val(),                                                                       
                                    alamat: jQuery('#alamat').val(), 
                                    telp: jQuery('#telepon').val(), 
                                    ktp: jQuery('#noktp').val(),
                                    no_anggota: jQuery('#no_anggota').val(),
                                    status: 1,
                                    admin: jQuery('#admin').val(),
                                    kelamin: jQuery("input[name=kelamin]:checked").val(),
                                  },                                                                                                   
                                  success: function(result){                                                        
                                    if(result.success == 'berhasil')                                                                      
                                    {    
                                      Swal(
                                        'Sukses!',
                                        'Data Nasabah Berhasil Ditambah',
                                        'success'
                                      ) 
                                      window.location = "{{url('/anggota')}}";                                                       
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
