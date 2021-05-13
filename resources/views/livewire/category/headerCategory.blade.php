<div class="d-flex flex-row justify-content-between align-items-center p-3 my-3 text-white bg-primary rounded shadow-sm">
    <div>
        <h2>Categories</h2>
    </div>
    <div>
        <h5>
            <button type="button" wire:click="ChangeCreatedMode()" class="btn btn-outline-light">
                <i class="fa fa-plus"></i> Add new
            </button>
        </h5>
    </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="form-row">
        <div class="col-12">
            <input wire:model="search" type="text" class="form-control" id="validationDefault03" required placeholder="Search ..." />
        </div>
    </div>
</div>
