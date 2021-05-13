<div>
    @include('livewire.post.headerPost')

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

    @if($createdMode)
        @include('livewire.post.newPost')
    @endif

    @if($updateMode)
        @include('livewire.post.updatePost')
    @endif

    @include('livewire.post.showPosts')


</div>

@section('javascript')
    <script>
        function AskPostDelete(postId) {
            Swal.fire({
                title: 'Are you sure delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if(result.isConfirmed){
                    const resultDelete = Livewire.emit('destroyPost', postId);
                    Swal.fire({title: 'Post successfully deleted', icon: 'success'});
                }
            });
        }

    </script>
@endsection
