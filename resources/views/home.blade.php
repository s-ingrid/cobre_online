@extends('auth.layout')
@section('auth.content')
{{auth()->user()}}
@endsection
