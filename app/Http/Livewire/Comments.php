<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $author_name, $email, $title, $body, $postId,$isAdminPanel = null;
    public $commentId = null;
    private $renderData = null;
    public $search = '';

    /**
     * config listeners thad can call from frontEnd
     *
     * @var string[]
     */
    protected $listeners = [
        'destroyComment' => 'destroy',
        'publishComment' => 'publish',
    ];

    protected $paginationTheme = 'bootstrap';


    /**
     * construct livewire life cycle and load data from database
     *
     * @param null $postId
     */
    public function mount($postId = null){
        $this->postId = $postId;
        $this->isAdminPanel = $postId == null;
    }

    /**
     * save a object of Comment model that load by livewire component
     */
    public function save()
    {
        $newComment = new Comment();
        $newComment->post_id = $this->postId;

        if (auth()->check()){

            /**
             * validate data when user login
             */
            $validatedData = $this->validate([
                'title' => 'bail|required|min:10|max:200',
                'body' => 'bail|required|min:10,max:200',
            ]);
            $newComment->user_id = auth()->user()->id;

            if (auth()->user()->id == 1){
                $newComment->status = Comment::StatusPublished;
            }

        } else {

            /**
             * validate data when user is guest
             */
            $validatedData = $this->validate([
                'title' => 'bail|required|min:10|max:200',
                'body' => 'bail|required|min:10,max:200',
                'email' => 'string|required|email',
                'author_name' => 'string|required',
            ]);

            $newComment->author_name = $validatedData['author_name'];
            $newComment->email = $validatedData['email'];
        }

        $newComment->title = $validatedData['title'];
        $newComment->body = $validatedData['body'];

        $newComment->save();
        $this->swAlert([
            'title' => 'Good job',
            'text' => 'successfully added',
            'icon' => 'success'
        ]);
        $this->resetAll();
        $this->render();

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
     * all class parameters to null
     */
    private function resetAll()
    {
        $this->author_name = null;
        $this->email = null;
        $this->title = null;
        $this->body = null;
        $this->commentId = null;
    }

    /**
     * delete $this loaded object use eloquent
     *
     * @param $commentId
     * @return bool
     */
    public function destroy($commentId)
    {
        $this->commentId = $commentId;
        $result = Comment::find($this->commentId)->forceDelete();
        $this->resetAll();
        $this->render();
        return $result === true;
    }

    /**
     * publish comment by $commentId
     *
     * @param $commentId
     * @return bool
     */
    public function publish($commentId){
        $this->commentId = $commentId;
        $result = Comment::find($this->commentId)
            ->update([ 'status' => Comment::StatusPublished ]);
        return $result == true;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if ($this->postId != null){
            if (auth()->check() && auth()->user()->id == 1){
                $this->renderData = Post::find($this->postId)->Comment()->orderBy('created_at', 'desc')->paginate(6);
            } else {
                $this->renderData = Post::find($this->postId)->Comment()->where('status',Comment::StatusPublished)->orderBy('created_at', 'desc')->paginate(6);
            }
        } else {

            if ($this->search != '' && Str::length($this->search) >= 4){
                $search = trim($this->search);
                $this->renderData = Comment::where('title', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->paginate(6);
            } else {
                $this->renderData = Comment::orderBy('created_at', 'desc')->paginate(6);
            }

        }
        return view('livewire.comment.mainComment',['comments' => $this->renderData]);
    }
}
