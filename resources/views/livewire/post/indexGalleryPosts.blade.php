<div class="container">
    <div class="row mx-0 my-3">
        <input wire:model="search" type="text" class="form-control" id="validationDefault03" required placeholder="Search ..." />
    </div>

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <a href="{{ $post->GetSingleRout()  }}" >
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{\App\Http\Controllers\ImageSaverController::GetPath(\App\Http\Controllers\ImageSaverController::Medium)}}{{ $post->url }}" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">{{ $post->title }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ \Carbon\Carbon::make($post->created_at)->toDateTimeString() }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}

</div>
