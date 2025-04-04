<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class AdminCategoriesSubcategoriesList extends Component
{
    // public $categories;

    public function render()
    {
        return view('livewire.admin-categories-subcategories-list', [
            'categories' => Category::orderBy('ordering', 'asc')->get()
        ]);
    }
}
