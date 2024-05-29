@extends('auth.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('auth.content')
    <div class="container">
        <div style="width: 24%; margin: auto;" class=" cb1 mt-5">
            <form class="form-group" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <img style="width: 100%;" class="text-center" src="{{ asset('images/logo.png') }}" alt="Logo Cobre Online">
                    <h3 class="text-center">Cadastro</h3>
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" placeholder="Maria Silva" name="name">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" placeholder="name@example.com" name="email">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password">
                    <button type="submit" class="btn btn-login">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
