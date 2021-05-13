@extends('layouts.mainBootstrap')
@section('container')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
@endsection