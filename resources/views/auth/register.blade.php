@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-lg" style="border: none; border-radius: 15px; overflow: hidden;">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <!-- Bagian Kiri dengan Logo -->
                        <div class="col-lg-5 d-none d-lg-flex align-items-center" style="background-color:rgb(0, 0, 0);">
                            <div class="p-5 text-center w-100">
                                <img src="{{ asset('img/logo-KGR.jpg') }}" alt="Logo KGR" class="img-fluid" style="max-height: 180px;">
                                <div class="mt-3 mx-auto" style="width: 60px; height: 3px; background-color: #ff0000;"></div>
                            </div>
                        </div>
                        <!-- Bagian Kanan dengan Form Register -->
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h2 class="h4 font-weight-bold" style="color: #333; letter-spacing: 0.5px;">Buat Akun Baru</h2>
                                    <p class="text-muted">Silakan isi form di bawah untuk mendaftar</p>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label text-muted small mb-1">Nama Depan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                                            <input type="text" id="name" class="form-control border-start-0 ps-2" name="name" 
                                                placeholder="{{ __('Nama Depan') }}" value="{{ old('name') }}" required autofocus
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="last_name" class="form-label text-muted small mb-1">Nama Belakang</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                                            <input type="text" id="last_name" class="form-control border-start-0 ps-2" name="last_name" 
                                                placeholder="{{ __('Nama Belakang') }}" value="{{ old('last_name') }}" required
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label text-muted small mb-1">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                            <input type="email" id="email" class="form-control border-start-0 ps-2" name="email"
                                                placeholder="{{ __('Alamat Email') }}" value="{{ old('email') }}" required
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password" class="form-label text-muted small mb-1">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" id="password" class="form-control border-start-0 ps-2" name="password"
                                                placeholder="{{ __('Password') }}" required
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password_confirmation" class="form-label text-muted small mb-1">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" id="password_confirmation" class="form-control border-start-0 ps-2" 
                                                name="password_confirmation" placeholder="{{ __('Konfirmasi Password') }}" required
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mt-5">
                                        <button type="submit"
                                            class="btn btn-block font-weight-bold py-2"
                                            style="background-color: #000; color: #fff; border-radius: 8px; transition: all 0.3s; font-size: 15px;"
                                            onmouseover="this.style.backgroundColor='#ff0000'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                                            onmouseout="this.style.backgroundColor='#000'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            {{ __('DAFTAR') }}
                                        </button>
                                    </div>
                                </form>

                                <hr>

                                <div class="text-center mt-4">
                                    <p class="small text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none" style="color: #ff0000;">Masuk</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
