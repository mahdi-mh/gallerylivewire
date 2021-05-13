<div>
    @include('livewire.tags.headerTags')

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
        @include('livewire.tags.newTags')
    @endif

    @if($updateMode)
        @include('livewire.tags.updateTags')
    @endif

    @include('livewire.tags.showTags')


</div>

@section('javascript')
    <script>
        function AskTagDelete(tagId) {
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
                    const resultDelete = Livewire.emit('destroyTag', tagId);
                    Swal.fire({title: 'Tag successfully deleted', icon: 'success'});
                }
            });
        }
    </script>
@endsection
