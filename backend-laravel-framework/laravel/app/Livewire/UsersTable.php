<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::orderBy('id','ASC')->where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%' . $this->search . '%')->paginate(10)
        ]);
    }
}
