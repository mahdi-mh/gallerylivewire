<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h4 class="border-bottom border-gray pb-2 mb-0">New Category</h4>
    <br>
    <div>
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" wire:model.defer="name" minlength="4" maxlength="200" required value="{{ old('name') }}"
                       class="form-control" id="name" placeholder="category name">
            </div>
            <hr/>
            <button type="submit" class="btn btn btn-primary"><i class="fa fa-check"></i> Save</button>
        </form>
        <button wire:click="ChangeCreatedMode()" class="btn btn-danger mt-1"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
