@extends('layouts.template')

@section('page-title')
    Detail {{$user->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Detail User</h3>
                    </div>      
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%">Nama</th>
                                <td width="5%"> : </td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th width="35%">Email</th>
                                <td width="5%"> : </td>
                                <td>{{$user->email}}</td>
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
                    <form action="{{route('penjual.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lengkap Penjual</label>
                            <input type="text" name="name" value="{{$user->name}}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="email" name="email" value="{{$user->email}}" required class="form-control">
                            <input type="text" name="level" hidden value="penjual">
                        </div>
                        <div class="form-group">
                            <label>Katasandi</label>
                            <input type="password" name="password" required class="form-control"
                                placeholder="Minimal 8 karakter, A-Z, a-z dan simbol">
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
