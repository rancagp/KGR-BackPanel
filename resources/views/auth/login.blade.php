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
                        <!-- Bagian Kanan dengan Form Login -->
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h2 class="h4 font-weight-bold" style="color: #333; letter-spacing: 0.5px;">Selamat Datang</h2>
                                    <p class="text-muted">Silakan login untuk melanjutkan</p>
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

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label text-muted small mb-1">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                            <input type="email" id="email" class="form-control border-start-0 ps-2" name="email"
                                                placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label text-muted small mb-1">Password</label>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" id="password" class="form-control border-start-0 ps-2" name="password"
                                                placeholder="{{ __('Password') }}" required
                                                style="border-radius: 8px; height: 45px; border: 1px solid #e0e0e0;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                                style="border-color: #666;">
                                            <label class="form-check-label small text-muted" for="remember">
                                                {{ __('Ingat Saya') }}
                                            </label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group mt-5">
                                        <button type="submit"
                                            class="btn btn-block font-weight-bold py-2"
                                            style="background-color: #000; color: #fff; border-radius: 8px; transition: all 0.3s; font-size: 15px;"
                                            onmouseover="this.style.backgroundColor='#ff0000'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                                            onmouseout="this.style.backgroundColor='#000'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            {{ __('MASUK') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection