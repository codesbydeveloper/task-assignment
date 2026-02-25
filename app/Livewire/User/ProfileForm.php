<?php

namespace App\Livewire\User;

use App\Services\UserService;
use Livewire\Component;

class ProfileForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $user = auth()->user();
        $this->name = (string) $user?->name;
        $this->email = (string) $user?->email;
    }

    public function update(UserService $userService): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.auth()->id()],
            'password' => ['nullable', 'string', 'min:8', 'same:password_confirmation'],
            'password_confirmation' => ['nullable', 'string', 'min:8'],
        ]);

        $passwordChanged = ! empty($data['password']);

        if (! $passwordChanged) {
            unset($data['password'], $data['password_confirmation']);
        }

        $userService->updateProfile(auth()->user(), $data);

        session()->flash('status', 'Profile updated.');
        if ($passwordChanged) {
            session()->flash('password_changed', true);
        }

        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.user.profile-form')
            ->layout('layouts.app', ['title' => 'Profile']);
    }
}

