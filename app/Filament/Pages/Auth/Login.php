<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;

class Login extends \Filament\Pages\Auth\Login
{
    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
    }
}
