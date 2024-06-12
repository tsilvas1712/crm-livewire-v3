<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'John Doe')
        ->set('email', 'jonh@doe.com')
        ->set('confirmed_email', 'jonh@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name'  => 'John Doe',
        'email' => 'jonh@doe.com',
    ]);

    assertDatabaseCount('users', 1);
});

test('Validation Rules', function ($f) {
    Livewire::test(Register::class)
        ->set($f->field, $f->value)
        ->call('submit')
        ->assertHasErrors([$f->field => $f->rule]);
})->with([
    'name::required'     => (object) ['field' => 'name', 'value' => '', 'rule' => 'required'],
    'name::max:255'      => (object) ['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max:255'],
    'email::required'    => (object) ['field' => 'email', 'value' => '', 'rule' => 'required'],
    'email::email'       => (object) ['field' => 'email', 'value' => 'no-an-email', 'rule' => 'email'],
    'email::max:255'     => (object) ['field' => 'email', 'value' => str_repeat('*', 256), 'rule' => 'max:255'],
    'password::required' => (object) ['field' => 'password', 'value' => '', 'rule' => 'required'],
]);
