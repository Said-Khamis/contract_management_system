<?php

namespace App\Http\Livewire;

use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

class User extends Component
{
    public $first_name, $last_name, $email, $role;
    public int $department_id, $designation_id;
    public ?int $institution_id = null;
    public \Illuminate\Database\Eloquent\Collection $roles;

    public function mount($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $rules = \App\Models\User::$rules;
        $this->validateOnly($propertyName, $rules);
    }

    public function render(): View
    {
        return view('user.fields');
    }
}
