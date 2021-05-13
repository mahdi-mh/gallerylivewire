@extends('layouts.mainTemplate.container')
@section('container')
    @if(\App\Models\Post::all()->count() !== 0)
        <div class="album py-1">
            @livewire('posts',['type' => 'indexGallery'])
        </div>
    @endif
@endsection
