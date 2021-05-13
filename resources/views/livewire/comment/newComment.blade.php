<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">New Comment</h6>
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="media text-muted pt-3">
        <div class="media-body pb-3 mb-0 lh-125">
            <form wire:submit.prevent="save">
                @csrf
                <div class="d-flex justify-content-between align-items-center w-100">
                    @if(!auth()->check())
                        <input wire:model.defer="author_name" value="{{old('author_name')}}" required max="100" min="2" type="text" class="form-control form-control-sm mt-1 mb-1 mr-1" placeholder="Enter your name"/>
                        <input wire:model.defer="email" value="{{old('email')}}" required type="email" class="form-control form-control-sm mt-1 mb-1 ml-1" placeholder="Enter your email"/>
                    @endif
                </div>
                <div class="w-100">
                    <input wire:model.defer="title" value="{{old('title')}}" required type="text" class="form-control form-control-sm mt-1 mb-1" placeholder="Comment title"/>
                </div>
                <div class="w-100">
                    <textarea wire:model.defer="body" required type="text" class="form-control form-control-sm mt-1 mb-1" placeholder="Comment body">
                        {{old('body')}}
                    </textarea>
                </div>
                <button class="btn btn-primary btn-sm">Submit comment</button>
            </form>
        </div>
    </div>
</div>


