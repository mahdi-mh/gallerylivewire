@extends('layouts.mainBootstrap')
@section('title', 'Comments Admin')
@section('container')
    <main role="main" class="container">

        <div class="d-flex flex-row justify-content-between align-items-center p-3 my-3 text-white bg-primary rounded shadow-sm">
            <div>
                <h2>Comments</h2>
            </div>
        </div>

        @livewire('comments')

    </main>
@endsection
