<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public string $name;

    public string $email;

    public string $password;

    public string $confirmed_email;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Create user logic here
    }
}
