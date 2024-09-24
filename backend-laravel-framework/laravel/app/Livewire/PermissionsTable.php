<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.permissions-table', [
            'permissions' => Permission::orderBy('id','ASC')->where('name', 'like', '%'.$this->search.'%')->paginate(10)
        ]);
    }
}
