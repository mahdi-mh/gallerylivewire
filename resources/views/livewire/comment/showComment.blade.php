<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent comments</h6>
    @foreach($comments as $comment)
        <div class="media text-muted pt-3">
            <img src="{{ asset('images/userAvater.png') }}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" />
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">
                        {{ $comment->title }}
                        @if(auth()->check() && auth()->user()->id == 1)
                            @if($comment->status == 1)
                                <span class="small bg-success text-white p-1 rounded">published</span>
                            @else
                                <span class="small bg-danger text-white p-1 rounded">pending</span>
                            @endif
                        @endif
                    </strong>
                    <div>
                        @if(auth()->check() && auth()->user()->id == 1)
                            <span><button class="btn btn-sm btn-outline-secondary" onclick="AskCommentDelete({{ $comment->id }})"><i class="fa fa-trash"></i> Delete</button></span>
                            @if($comment->status != 1)
                                <span><button class="btn btn-sm btn-outline-primary" onclick="AskCommentPublished({{ $comment->id }})"><i class="fa fa-check ml-1"></i> Publish</button></span>
                            @endif
                        @endif
                    </div>
                </div>
                <span class="d-block">
                    <span>Author :
                        @if($comment->author_name == null)
                            {{ $comment->User()->first()->name }}
                        @else
                            {{$comment->author_name}}
                        @endif
                    </span>
                    <span class="small ml-1">
                       {{ \Carbon\Carbon::make($comment->updated_at)->toDateTimeString() }}
                    </span>
                </span>
                @if($isAdminPanel)
                    Post : <a href="/posts/{{ $comment->post->id }}"><span>{{ $comment->post->title }}</span></a>
                @endif
                <div class="w-100 mt-1">
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
        </div>
    @endforeach
    @if(count($comments) == 0)
        <p class="small text-muted">No comments published yet</p>
    @endif
    <div class="d-block text-right mt-3">
        {{ $comments->links() }}
    </div>
</div>


