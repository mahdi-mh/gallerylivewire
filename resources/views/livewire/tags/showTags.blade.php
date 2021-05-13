<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="form-row">
        <div class="col-12">
            <input wire:model="search" type="text" class="form-control" id="validationDefault03" required placeholder="Search ..." />
        </div>
    </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent Categories</h6>
    @foreach ($tags as $tag)
        <div class="text-muted justify-content-between align-items-center align-content-center d-flex border-bottom border-gray" style="margin: 4px 0px;padding: 4px 0px;">
            <div class="d-flex justify-content-center align-items-center">
                <span class="media-body small">
                    <strong class="d-block text-gray-dark">{{ $tag->name }}</strong>
                    @foreach($tag->post->take(5) as $post)
                        <a href="/posts/{{ $post->id }}"><div class="text-muted">post : {{ $post->title }}</div></a>
                    @endforeach
                </span>
            </div>
            <div>
                <button type="button" wire:click="ShowUpdatedMode({{ $tag->id }})" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> edit</button>
                <button type="button" onclick="AskTagDelete({{ $tag->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> remove</button>
            </div>
        </div>
    @endforeach
    <br/>
    {{ $tags->links() }}
</div>
