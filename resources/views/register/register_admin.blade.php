@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <img src="{{asset('logo')}}/logo.png" alt="User Image" width="100px" height="100px"><br>
                    <br>
                    <a href="#" class="h5">SISTEM INFORMASI MAHASISWA UNRAM</a><br>
                    <small>Jl Majapahit no 62, Mataram</small>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register Admin</p>
                    <form action="{{route('simpan_data_admin_baru')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email Admin</label>
                            <input type="email" name="email_admin" class="form-control @error('email_admin') is-invalid @enderror" placeholder="Masukkan Email Admin" value="{{old('email_admin')}}">
                            @error('email_admin')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" name="nama_admin" class="form-control @error('nama_admin') is-invalid @enderror" placeholder="Masukkan Nama Admin" value="{{old('nama_admin')}}">
                            @error('nama_admin')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" value="{{old('password')}}">
                            @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection