<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('is_admin')->orderBy('name')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', Password::defaults(), 'confirmed'],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        $isAdmin = $request->boolean('is_admin');

        if ($user->is_admin && ! $isAdmin && $this->isLastAdmin($user)) {
            return back()->with('error', 'Cannot remove admin access from the last remaining admin.')->withInput();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = $isAdmin;

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->is_admin && $this->isLastAdmin($user)) {
            return back()->with('error', 'Cannot delete the last remaining admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    private function isLastAdmin(User $user): bool
    {
        return User::where('is_admin', true)->where('id', '!=', $user->id)->doesntExist();
    }
}
