@extends('layouts.mainTemplate.container')
@section('container')
    <main role="main" class="container">
        <div class="d-flex flex-row justify-content-between align-items-center p-3 my-3 text-white bg-primary rounded shadow-sm">
            <div class="lh-100">
                <h5 class="mb-0 text-white lh-100">{{ $post->title }}</h5>
                <strong>{{ $post->Category()->first()->name }}</strong>  <small>{{ \Carbon\Carbon::make($post->created_at)->toDateTimeString() }}</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div>
                <img style="width: 100%" src="{{\App\Http\Controllers\ImageSaverController::GetPath(\App\Http\Controllers\ImageSaverController::LargeHd)}}{{ $post->url }}" alt="{{ $post->title }}" title="{{ $post->title }}"/>
            </div>
            <div class="media text-muted pt-3">
                <img src="{{asset('images/userAvater.png')}}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" />
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">Author : {{ $post->user->name }}</strong>
                    {{ $post->caption }}
                </p>
            </div>
            <div class="media text-muted pt-3">
                @foreach($post->tag as $tag)
                    <span class="m-1">#{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        @livewire('comments', ['postId' => $post->id ])

    </main>
@endsection
