<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/debug-auth', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return [
            'is_logged_in' => true,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'is_admin_check' => $user->isAdmin(),
        ];
    }
    return ['is_logged_in' => false];
});
