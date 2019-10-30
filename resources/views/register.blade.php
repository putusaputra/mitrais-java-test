@extends('layouts.app')

@section('content')
    <register-form :register-url-val="'{{ route('register.user') }}'" :login-url-val="'{{ route('login.user') }}'"></register-form>
@endsection