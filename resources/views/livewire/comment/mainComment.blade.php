<div>
        @if(!$isAdminPanel)
            @include('livewire.comment.newComment')
        @endif

        @if($isAdminPanel)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="form-row">
                        <div class="col-12">
                            <input wire:model="search" type="text" class="form-control" id="validationDefault03" required placeholder="Search ..." />
                        </div>
                    </div>
                </div>
        @endif

    @include('livewire.comment.showComment')
</div>

@section('javascript')
    <script>
        function AskCommentDelete(commentId) {
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
                    const resultDelete = Livewire.emit('destroyComment', commentId);
                    Swal.fire({title: 'Comment successfully deleted', icon: 'success'});
                }
            });
        }

        function AskCommentPublished(commentId) {
            Swal.fire({
                title: 'Are you sure publish?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, publish it',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if(result.isConfirmed){
                    const resultDelete = Livewire.emit('publishComment', commentId);
                    Swal.fire({title: 'Comment successfully published', icon: 'success'});
                }
            });
        }
    </script>
@endsection
