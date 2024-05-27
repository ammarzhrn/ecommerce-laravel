@extends('layouts.template')

@section('page-title')
    Detail Toko {{$data->nama_toko}}
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
  </div>
@endif

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Detail Toko</h3>
                    </div>      
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama Toko</th>
                                <td width="5%"> : </td>
                                <td width="70%">
                                    {{$data->nama_toko}}
                                    @if($data->aktif == false)
                                    <span class="badge badge-danger mx-3">Tidak Aktif</span>
                                    @else
                                    <span class="badge badge-success mx-3">Aktif</span>
                                    @endif</td>
                                <td rowspan="7"><img src="{{asset('storage/image/toko/'.$data->icon_toko)}}" alt="Gambar"></td>

                            </tr>
                            <tr>
                                <th>Pemilik</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$data->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td width="5%"> : </td>
                                <td width="70%">{!! $data->desc_toko !!}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$data->kategori_toko}}</td>
                            </tr>
                            <tr>
                                <th>Hari Buka</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$data->hari_buka}}</td>
                            </tr>
                            <tr>
                                <th>Jam Operasi</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$data->jam_buka}} - {{$data->jam_libur}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data</h3>
    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('toko.update', $data->id)}}" method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="icon_toko" id="image" class="form-control">
                            @if($data->icon_toko)
                                <img src="{{asset('storage/image/toko/'.$data->icon_toko)}}" alt="" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" value="{{$data->nama_toko}}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori_toko" value="{{$data->ketagori_toko}}" id="">
                                <option value="elektronik">Elektronik</option>
                                <option value="otomotif">otomotif</option>
                                <option value="sembako">Sembako</option>
                                <option value="fashion">Fashion</option>
                                <option value="makanan">Makanan</option>
                                <option value="obat">Obat</option>
                                <option value="aksesoris">Aksesoris</option>
                                <option value="perabotan">Perabotan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Toko</label>
                            <textarea id="summernote" name="desc_toko">{!! $data->desc_toko !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Hari Buka : </label>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="senin"
                                    value="senin">
                                <label for="senin" class="custom-control-label">Senin</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="selasa"
                                    value="selasa">
                                <label for="selasa" class="custom-control-label">Selasa</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="rabu"
                                    value="rabu">
                                <label for="rabu" class="custom-control-label">Rabu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="kamis"
                                    value="kamis">
                                <label for="kamis" class="custom-control-label">Kamis</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="jumat"
                                    value="jumat">
                                <label for="jumat" class="custom-control-label">Jumat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="sabtu"
                                    value="sabtu">
                                <label for="sabtu" class="custom-control-label">Sabtu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="minggu"
                                    value="minggu">
                                <label for="minggu" class="custom-control-label">Minggu</label>
                            </div>
                        </div>
                        <div class="row justify-between">
                            <div class="form-group col-md-6">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" name="jam_buka" value="{{$data->jam_buka}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" name="jam_libur" value="{{$data->jam_libur}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="aktif" class="form-control" required id="">
                                <option value="0">Tidak Aktif</option>
                                <option value="2">Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
