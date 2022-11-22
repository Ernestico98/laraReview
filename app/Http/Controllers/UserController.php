<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('media')->paginate(10);

        return view('users.index', compact('users'));
    }

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
                'image' => ['nullable', 'file', 'image'],
            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => ($request->isAdmin === null) ? false : true,
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', ($user->email != $request->email) ? 'unique:'.User::class : ''],
                'image' => ['nullable', 'file', 'image'],
            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'isAdmin' => ($request->isAdmin === null) ? false : true,
            ]);
        }

        if ($request->has('image')) {
            $user->media()->first()?->delete();
            $user->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('users.show', $id);
    }
}
