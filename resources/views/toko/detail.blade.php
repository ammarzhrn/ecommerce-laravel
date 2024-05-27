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
                    <form action="{{ route('toko.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="icon_toko" id="image" class="form-control">
                            @if($data->icon_toko)
                                <img src="{{ asset('storage/image/toko/' . $data->icon_toko) }}" alt="" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" value="{{ $data->nama_toko }}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori_toko">
                                <option value="elektronik" {{ $data->kategori_toko == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="otomotif" {{ $data->kategori_toko == 'otomotif' ? 'selected' : '' }}>Otomotif</option>
                                <option value="sembako" {{ $data->kategori_toko == 'sembako' ? 'selected' : '' }}>Sembako</option>
                                <option value="fashion" {{ $data->kategori_toko == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="makanan" {{ $data->kategori_toko == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="obat" {{ $data->kategori_toko == 'obat' ? 'selected' : '' }}>Obat</option>
                                <option value="aksesoris" {{ $data->kategori_toko == 'aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="perabotan" {{ $data->kategori_toko == 'perabotan' ? 'selected' : '' }}>Perabotan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Hari Buka : </label>
                            @php
                                $hari_buka = explode(',', $data->hari_buka);
                            @endphp
                            @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $hari)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="{{ $hari }}" value="{{ $hari }}" {{ in_array($hari, $hari_buka) ? 'checked' : '' }}>
                                    <label for="{{ $hari }}" class="custom-control-label">{{ ucfirst($hari) }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Toko</label>
                            <textarea id="summernote" name="desc_toko" class="form-control">{!! $data->desc_toko !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" name="jam_buka" value="{{ $data->jam_buka }}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_libur">Jam Tutup</label>
                                <input type="time" name="jam_libur" value="{{ $data->jam_libur }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="aktif" class="form-control" required>
                                <option value="0" {{ $data->aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="2" {{ $data->aktif == 2 ? 'selected' : '' }}>Aktif</option>
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
