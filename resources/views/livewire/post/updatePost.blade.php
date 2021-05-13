<div class="my-3 p-3 bg-white rounded shadow-sm" on>
    <h4 class="border-bottom border-gray pb-2 mb-0">Update Post</h4>
    <br>
    <div>
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="title">Title</label>
                    <input type="text" wire:model.defer="title" minlength="10" maxlength="200" required value="{{ old('title') }}"
                           class="form-control" id="title" placeholder="title">
                </div>
                <div class="form-group col-6">
                    <label for="categorySelect">Category select</label>
                    <select wire:model.defer="categories" required class="form-control" id="categorySelect">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" @if(old('categories') == $category->id) selected @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-2">
                        @if ($image)
                            <img width="360" height="200" class="mr-1" src="{{ $image->temporaryUrl() }}">
                        @else
                            <img src="{{ \App\Http\Controllers\ImageSaverController::GetPath(\App\Http\Controllers\ImageSaverController::Medium) }}{{ $imagePath }}" alt="{{ $imagePath }}" title="{{ $imagePath }}"/>
                        @endif
                    </div>
                    <div class="custom-file mb-3">
                        <input accept="image/*" type="file" size="512" class="custom-file-input" id="customFile"
                               wire:model.defer="image"
                               onchange="document.getElementsByClassName('custom-file-label')[0].innerHTML = $(this).val().split('\\').pop();">
                        <label class="custom-file-label" for="customFile">@if ($image){{ $image->temporaryUrl() }} @else Choose image @endif</label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <textarea type="text" wire:model.defer="caption" minlength="10" maxlength="200" required
                                  class="form-control" id="caption" placeholder="caption">{{ old('caption') }}</textarea>
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="tags" class="form-control" multiple="multiple" multiple>
                            @foreach(\App\Models\Tag::all() as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr/>
            <button type="submit" class="btn btn btn-primary"><i class="fa fa-check"></i> Update</button>
        </form>
        <button wire:click="ChangeUpdateMode()" class="btn btn-danger mt-1"><i class="fa fa-times"></i> Close</button>

    </div>
</div>
