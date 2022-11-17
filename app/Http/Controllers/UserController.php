<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $auth_user = auth()->user();

        if (! $auth_user->isAdmin && $user->id != $auth_user->id) {
            abort(403);
        }

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $auth_user = auth()->user();

        if (! $auth_user->isAdmin && $user->id != $auth_user->id) {
            abort(403);
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->password) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', ($user->email != $request->email) ? 'unique:'.User::class : ''],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', ($user->email != $request->email) ? 'unique:'.User::class : ''],
            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('users.show', $id);
    }
}
