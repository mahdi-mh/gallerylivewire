<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $name;
    public $categoryId = null;
    public $createdMode = false;
    public $updateMode = false;
    public $search = '';

    /**
     * config listeners thad can call from frontEnd
     *
     * @var string[]
     */
    protected $listeners = ['destroyCategory' => 'destroy'];

    protected $paginationTheme = 'bootstrap';

    /**
     * validation rules
     *
     * @return string[]
     */
    protected function rules(){
        return [
            'name' => 'string|required|unique:categories|min:4|max:200',
        ];
    }

    /**
     * save a object of Category model that load by livewire component
     */
    public function save()
    {
        $this->validate();
        $this->CategorySaver();
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
     * update object Category model that load by livewire component
     */
    public function update(){
        if ($this->categoryId != null){
            $this->save();
        }
    }


    /**
     * save $this loaded object use by eloquent
     */
    private function CategorySaver(){
        if ($this->updateMode){
            $category = Category::find($this->categoryId);
        } else {
            $category = new Category();
        }
        $category->name = $this->name;
        $category->user_id = auth()->user()->id;
        $category->save();
    }

    /**
     * all class parameters to null
     */
    private function resetAll() { $this->name = null; }

    /**
     * delete $this loaded object use eloquent
     *
     * @param $categoryId
     * @return bool
     */
    public function destroy($categoryId)
    {
        $this->categoryId = $categoryId;
        $result = Category::find($this->categoryId)->forceDelete();
        $this->resetAll();
        $this->render();
        return $result === true;
    }

    /**
     * ready to update from view
     */
    public function RenderUpdateMode(){
        if ( $this->categoryId != null){
            $categorySelected = Category::find($this->categoryId);
            $this->name = $categorySelected->name;
        }
    }

    public function ChangeCreatedMode() { $this->createdMode = !$this->createdMode; }
    public function ChangeUpdateMode() { $this->updateMode = !$this->updateMode; }

    /**
     * call from categories table to show update form
     *
     * @param null $categoryId
     */
    public function ShowUpdatedMode($categoryId = null) {
        $this->categoryId = $categoryId;
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
            $data = Category::where('name', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $data = Category::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('livewire.category.mainCategory',['categories' => $data]);
    }
}
