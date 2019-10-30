@extends('layouts.app')

@section('content')
    <register-form :register-url-val="'{{ route('register.user') }}'"></register-form>
@endsection