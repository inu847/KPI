@extends('layouts.auth')

@section('title')
    Registrasi
@endsection

@section('content')
    <div class="card card-center col-md-6">
        <div class="card-body">
            @if (session('status'))
                <span class="alert alert-danger">{{session('status')}}</span> 
            @endif
            <form action="{{ route('registrasiUser')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <img class="mb-4 rounded mx-auto d-block" src="{{ asset('img/logoo.png')}}" alt="" width="150" height="150">
                <p>&larr; <a href="{{ url('/') }}">Home</a>
                    <h4> DAFTAR SISTEM PENDUKUNG KEPUTUSAN PENENTUAN JURUSAN</h4>
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>

                <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                </div>

                <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" required> Cheked me
                </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
                
            </form>
        </div>
    </div>
@endsection