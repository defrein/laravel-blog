<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PostList extends Component
{

    use WithPagination;

    #[Url]
    public $sort = "desc";

    #[Url]
    public $search = "";

    #[Url]
    public $category = "";

    public function setSort($sort){
        $this->sort = ($sort == "desc") ?"desc":"asc";
        // $this->resetPage();
    }

    #[On("search")]
    public function updateSearch($search){
        $this->search = $search;
        $this->resetPage();
    }

    public function clearFilter(){
        $this->search = "";
        $this->category = "";
        $this->resetPage();
    }

    #[Computed()]
    public function posts(){
        return Post::published()->orderBy('published_at', $this->sort)
        ->when($this->activeCategory, function ($query) {
            $query->withCategory($this->category);
        })
        ->where('title', 'like', "%{$this->search}%")
        ->paginate(10);
    }

    #[Computed()]
    public function activeCategory(){
        return Category::where("slug", $this->category)->first();
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
