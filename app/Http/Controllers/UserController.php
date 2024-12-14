<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorisationRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function registrationPost(RegistrationRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('welcome');
    }

    public function authorisationPost(AuthorisationRequest $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }
        return back()->withErrors(['error' => 'Похоже такого аккаунта нет']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return back()->with(['success' => 'Вы успешно вышли']);
    }
}
