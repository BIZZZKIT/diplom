<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorisationRequest;
use App\Http\Requests\EditProfileRequest;
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
            if (Auth::user()->is_admin){
                $request->session()->regenerate();
                return redirect()->route('admin');
            }
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
    public function update(EditProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $user->update($validated);

        return redirect()->back()->with('successEdited', 'Профиль успешно обновлён.');
    }
}
