<div class="my-3 p-3 bg-white rounded shadow-sm" on>
    <h4 class="border-bottom border-gray pb-2 mb-0">Update Category</h4>
    <br>
    <div>
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" wire:model.defer="name" minlength="4" maxlength="200" required value="{{ old('name') }}"
                       class="form-control" id="name" placeholder="category name">
            </div>
            <hr/>
            <button type="submit" class="btn btn btn-primary"><i class="fa fa-check"></i> Update</button>
        </form>
        <button wire:click="ChangeUpdateMode()" class="btn btn-danger mt-1"><i class="fa fa-times"></i> Close</button>

    </div>
</div>
