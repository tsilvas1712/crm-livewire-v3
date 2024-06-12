<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(["required", "max:255"])]
    public string $name;

    #[Rule(["required", "email", "max:255"])]
    public string $email;

    #[Rule("required")]
    public string $password;

    public ?string $confirmed_email;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Create user logic here
    }
}
