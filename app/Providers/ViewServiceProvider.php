<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $chats = Chat::where('user_one_id', $user->id)
                    ->orWhere('user_two_id', $user->id)
                    ->get();
                $view->with('chats', $chats);
            }
        });
    }

    public function register(): void {}
}

