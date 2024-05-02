@extends('template')

@section('user')
User
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Data Pemilik Toko</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
                            Tambah Data
                        </button>
                    </div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </td>
                            @endforeach

                    </tbody>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data User (penjual)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('penjual.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Lengkap Penjual</label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Email</label>
                        <input type="email" name="email" required class="form-control">
                        <input type="text" name="level" hidden value="seller">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" required class="form-control" placeholder="Minimal 8 Karakter">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
