@extends('layouts.mainBootstrap')
@section('container')
    <div class="album py-5">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
@endsection