@extends('auth.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('auth.content')
    <div class="container">
        <div style="width: 24%; margin: auto;" class=" cb1 mt-5">
            <form class="form-group" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <img style="width: 100%;" class="text-center" src="{{ asset('images/logo.png') }}" alt="Logo Cobre Online">
                    <h3 class="text-center">Login</h3>
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="name@example.com" name="email">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password">
                    <button type="submit" class="btn btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
