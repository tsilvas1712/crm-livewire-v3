<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'John Doe')
        ->set('email', 'jonh@doe.com')
        ->set('confirmed_email', 'jonh@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();
});
