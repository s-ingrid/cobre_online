@extends('auth.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('auth.content')
    <div class="container-div">
        <div class="right-panel"></div>
        <div class="left-panel">
            <div>
                <form class="form-group" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Cobre Online">
                        </div>
                        <div class="input-group flex-nowrap my-2">
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at"></i></span>
                            <input type="email" class="form-control form-control-lg" placeholder="name@example.com" name="email">
                        </div>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text"><i class="bi bi-unlock"></i></span>
                            <input type="password" class="form-control form-control-lg" placeholder="*******" name="password">
                        </div>
                        <div class="d-flex justify-content-center mb-5">
                            <button type="submit" class="btn btn-login btn-lg mt-5">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
