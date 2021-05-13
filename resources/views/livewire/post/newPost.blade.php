<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h4 class="border-bottom border-gray pb-2 mb-0">New Post</h4>
    <br>
    <div>
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" wire:model.defer="title" minlength="10" maxlength="200" required value="{{ old('title') }}"
                               class="form-control" id="title" placeholder="title">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="categorySelect">Category select</label>
                        <select wire:model.defer="categories" required class="custom-select" id="categorySelect">
                            <option selected>Choose ...</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" @if(old('categories') == $category->id) selected @endif >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group d-flex justify-content-between">
                        <span>
                            @if ($image)<img width="35" height="35" class="mr-1" src="{{ $image->temporaryUrl() }}">@endif
                        </span>
                        <span class="custom-file">
                            <input accept="image/*" type="file" size="512" class="custom-file-input" id="customFile" wire:model.defer="image" value="{{ old('image') }}"
                                  oninput="document.getElementsByClassName('custom-file-label')[0].innerHTML = $(this).val().split('\\').pop();">
                            <label class="custom-file-label" for="customFile">@if ($image){{ $image->temporaryUrl() }} @else Choose image @endif</label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <textarea type="text" wire:model.defer="caption" minlength="10" maxlength="200" required
                                  class="form-control" id="caption" placeholder="caption">{{ old('caption') }}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select required wire:model.defer="tags" id="tags" class="form-control" multiple="multiple" multiple>
                            @foreach(\App\Models\Tag::all() as $tag)
                                <option value="{{ $tag->id }}" @if(is_array(old('tags')) && in_array($tag->id,old('tags'))) selected @endif>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr/>
            <button type="submit" class="btn btn btn-primary"><i class="fa fa-check"></i> Save</button>
        </form>
        <button wire:click="ChangeCreatedMode()" class="btn btn-danger mt-1"><i class="fa fa-times"></i> Close</button>

    </div>
</div>
