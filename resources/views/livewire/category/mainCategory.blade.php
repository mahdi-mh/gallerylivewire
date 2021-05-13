<div>
    @include('livewire.category.headerCategory')

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
        @include('livewire.category.newCategory')
    @endif

    @if($updateMode)
        @include('livewire.category.updateCategory')
    @endif

    @include('livewire.category.showCategory')


</div>

@section('javascript')
    <script>
        function AskCategoryDelete(categoryId) {
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
                    const resultDelete = Livewire.emit('destroyCategory', categoryId);
                    Swal.fire({title: 'Category successfully deleted', icon: 'success'});
                }
            });
        }

    </script>
@endsection
