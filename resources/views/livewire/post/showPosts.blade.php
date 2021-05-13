<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="form-row">
        <div class="col-12">
            <input wire:model="search" type="text" class="form-control" id="validationDefault03" required placeholder="Search ..." />
        </div>
    </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent posts</h6>
    @foreach ($posts as $post)
        <div id="post-{{ $post->id }}" class="text-muted justify-content-between align-items-center align-content-center d-flex border-bottom border-gray" style="margin: 4px 0px;padding: 4px 0px;">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ \App\Http\Controllers\ImageSaverController::GetPath(\App\Http\Controllers\ImageSaverController::Small) }}{{ $post->url }}" class="bd-placeholder-img mr-2 rounded" width="40" height="40" />
                <span class="media-body small">
                    <a href="{{ $post->GetSingleRout() }}">
                        <strong class="d-block text-gray-dark">{{ $post->title }}</strong>
                    </a>
                    <strong>Category : {{ $post->category->name }}</strong> {{ \Carbon\Carbon::make($post->created_at)->toDateTimeString() }}
                </span>
            </div>
            <div>
                <button type="button" wire:click="ShowUpdatedMode({{ $post->id }})" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> edit</button>
                <button type="button" onclick="AskPostDelete({{ $post->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> remove</button>
            </div>
        </div>
    @endforeach
    <br/>
    {{ $posts->links() }}
</div>
