<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    public $name;
    public $tagId = null;
    public $createdMode = false;
    public $updateMode = false;
    public $search = '';

    /**
     * config listeners thad can call from frontEnd
     *
     * @var string[]
     */
    protected $listeners = ['destroyTag' => 'destroy'];

    protected $paginationTheme = 'bootstrap';

    /**
     * validation rules
     *
     * @return string[]
     */
    protected function rules(){
        return [
            'name' => 'string|required|unique:tags|min:4|max:200',
        ];
    }

    /**
     * save a object of Tag model that load by livewire component
     */
    public function save()
    {
        $this->validate();
        $this->TagSaver();
        $this->resetAll();
        $this->createdMode = false;
        $this->updateMode = false;
        $this->swAlert([
           'title' => 'Good job',
           'text' => 'Successfully saved',
           'icon' => 'success'
        ]);
        $this->render();
    }

    /**
     * update object Tag model that load by livewire component
     */
    public function update(){
        if ($this->tagId != null){
            $this->save();
        }
    }

    /**
     * save $this loaded object use by eloquent
     */
    private function TagSaver(){
        if ($this->updateMode){
            $tag = Tag::find($this->tagId);
        } else {
            $tag = new Tag();
        }
        $tag->name = $this->name;
        $tag->save();
    }

    /**
     * all class parameters to null
     */
    private function resetAll() { $this->name = null; }

    /**
     * delete $this loaded object use eloquent
     *
     * @param $tagId
     * @return bool
     */
    public function destroy($tagId)
    {
        $this->tagId = $tagId;
        $result = Tag::find($this->tagId)->forceDelete();
        $this->resetAll();
        $this->render();
        return $result === true;
    }

    /**
     * ready to update from view
     */
    public function RenderUpdateMode(){
        if ( $this->tagId != null){
            $categorySelected = Tag::find($this->tagId);
            $this->name = $categorySelected->name;
        }
    }

    public function ChangeCreatedMode() { $this->createdMode = !$this->createdMode; }
    public function ChangeUpdateMode() { $this->updateMode = !$this->updateMode; }

    /**
     * call from tags table to show update form
     *
     * @param null $tagId
     */
    public function ShowUpdatedMode($tagId = null) {
        $this->tagId = $tagId;
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
            $data = Tag::where('name', 'LIKE', "%{$search}%")->orderBy('id', 'desc')->paginate(6);
        } else {
            $data = Tag::orderBy('id', 'desc')->paginate(6);
        }

        return view('livewire.tags.mainTags',['tags' => $data]);
    }
}
