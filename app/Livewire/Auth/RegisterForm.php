<?php

namespace App\Livewire\Auth;

use App\Services\UserService;
use Livewire\Component;

class RegisterForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'same:password_confirmation'],
        'password_confirmation' => ['required', 'string', 'min:8'],
    ];

    public function submit(UserService $userService): void
    {
        $this->validate();

        $userService->createUser([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        session()->flash('status', 'Registration successful. You may log in.');

        $this->redirectRoute('login');
    }

    public function render()
    {
        return view('livewire.auth.register-form')
            ->layout('layouts.app', ['title' => 'Register']);
    }
}

