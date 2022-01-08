@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="card card-center col-md-6">
        <div class="card-body">
            @if (session('status'))
                <span class="alert alert-danger">{{session('status')}}</span> 
            @endif
            <form action="{{ route('user.login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <img class="mb-4 rounded mx-auto d-block" src="{{ asset('asset/logo.png')}}" alt="" width="150" height="250">
                <p>&larr; <a href="{{ url('/') }}">Home</a>

                    <h4>MASUK KE SISTEM STOCK BARANG</h4>
                    <p>Belum punya akun? <a href="{{ route('user.todoRegistrasi') }}">Daftar di sini</a></p>
        
                <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" autofocus>
                </div>
        
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </div>
@endsection