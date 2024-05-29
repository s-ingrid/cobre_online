@extends('auth.layout')
@section('auth.content')
{{auth()->user()}}
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection
