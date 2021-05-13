<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ImageSaverController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination,WithFileUploads;

    public $title, $caption, $categories, $image;
    public $tags;
    public $imagePath;
    public $postId = null;
    public $type = null;
    public $createdMode = false;
    public $updateMode = false;
    public $search = '';

    /**
     * config listeners thad can call from frontEnd
     *
     * @var string[]
     */
    protected $listeners = ['destroyPost' => 'destroy'];

    protected $paginationTheme = 'bootstrap';

    /**
     * validation rules
     *
     * @return string[]
     */
    protected function rules(){
        return [
            'title' => 'bail|required|min:10|max:200',
            'categories' => 'bail|required|exists:categories,id',
            'caption' => 'bail|required|min:10,max:200',
            'tags' => 'required'
        ];
    }

    /**
     * save a object of Post model that load by livewire component
     */
    public function save()
    {
        $this->validate();
        $this->validate(['image' => 'required|image']);

        // try to upload image and resize by ImageSaverController config
        try {
            $imageSaver = new ImageSaverController();
            $this->imagePath = $imageSaver->loadImage($this->image->getRealPath())->saveAllSizes();
        }catch (\RuntimeException $exception){
            dd($exception);
        }

        $this->PostSaver();

        $this->resetAll();
        $this->ChangeCreatedMode();
        $this->swAlert([
            'title' => 'Good job',
            'text' => 'successfully added',
            'icon' => 'success'
        ]);
        $this->render();
    }

    /**
     * update object Post model that load by livewire component
     */
    public function update(){
        if ($this->postId != null){
            $this->validate();

            /**
             * if change image
             * try to upload image and resize by ImageSaverController config
             * delete old images from upload directory
             */
            if (isset($this->image) && $this->image != null){
                $this->validate(['image' => 'required|image']);
                try {
                    $imageSaver = new ImageSaverController();
                    $newImagePath = $imageSaver->loadImage($this->image->getRealPath())->saveAllSizes();
                    ImageSaverController::DeleteAllPhotos($this->imagePath);
                    $this->imagePath = $newImagePath;
                }catch (\RuntimeException $exception){
                    dd($exception);
                }
            }

            $this->PostSaver();
            $this->resetAll();
            $this->ChangeUpdateMode();
            $this->swAlert([
                'title' => 'Good job',
                'text' => 'successfully updated',
                'icon' => 'success'
            ]);
            $this->render();

        }
    }

    /**
     * save $this loaded object use by eloquent
     */
    private function PostSaver(){
        if ($this->updateMode){
            $post = Post::find($this->postId);
        } else {
            $post = new Post();
        }
        $post->user_id = Auth::user()->id;
        $post->title = $this->title;
        $post->category_id = (int)$this->categories;
        $post->caption = $this->caption;
        $post->url = $this->imagePath;
        $post->save();
        $post->Tag()->sync($this->tags);
    }

    /**
     * all class parameters to null
     */
    private function resetAll()
    {
        $this->title = null;
        $this->caption = null;
        $this->categories = null;
        $this->image = null;
        $this->tags = null;
        $this->imagePath = null;
        $this->postId = null;
    }

    /**
     * delete $this loaded object use eloquent
     *
     * @param $postId
     * @return bool
     */
    public function destroy($postId)
    {
        $this->postId = $postId;
        $result = Post::find($this->postId)->ForceDeleteByPhotos();
        $this->resetAll();
        $this->render();
        return $result === true;
    }

    /**
     * ready to update from view
     */
    public function RenderUpdateMode(){
        if ( $this->postId != null){
            $postSelected = Post::find($this->postId);
            $this->title = $postSelected->title;
            $this->caption = $postSelected->caption;
            $this->categories = $postSelected->category_id;
            $this->imagePath = $postSelected->url;
            $this->tags = $postSelected->tag()->pluck('id')->toArray();
        }
    }

    public function ChangeCreatedMode() { $this->createdMode = !$this->createdMode; }
    public function ChangeUpdateMode() { $this->updateMode = !$this->updateMode; }


    /**
     * call from posts table to show update form
     *
     * @param null $postId
     */
    public function ShowUpdatedMode($postId = null) {
        $this->postId = $postId;
        $this->RenderUpdateMode();
        $this->ChangeUpdateMode();
    }

    /**
     * notification by sweetAlert js
     *
     * @param array $data
     */
    public function swAlert(array $data){
        $this->dispatchBrowserEvent('swAlert',$data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if ($this->search != '' && Str::length($this->search) >= 4){
            $search = trim($this->search);
            $data = Post::where('title', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $data = Post::orderBy('created_at', 'desc')->paginate(6);
        }

        if ($this->type != null && $this->type == 'indexGallery'){
            return view('livewire.post.indexGalleryPosts',['posts' => $data]);
        } else {
            return view('livewire.post.mainPost',['posts' => $data]);
        }

    }
}
