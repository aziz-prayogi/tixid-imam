@extends('tenplates.app')

@section('content')
    <div class="container">
        <h5>Grafik Pembelian Tiket</h5>
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('succeess') }} <b>selamat datang, {{ Auth::user()->name }}</b>
            </div>

        @endif
    </div>

@endsection
