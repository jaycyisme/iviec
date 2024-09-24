<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesTable extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.roles-table', [
            'roles' => Role::orderBy('id','ASC')->where('name', 'like', '%'.$this->search.'%')->paginate(10)
        ]);
    }
}
