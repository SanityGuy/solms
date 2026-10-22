<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'username'     => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@solms\.id$/i'],
            'password'     => ['required', 'string', 'min:8'],
            'role'         => ['required', Rule::in(['admin', 'student'])],
        ], [
            'email.regex'  => 'Email must end with @solms.id',
        ]);

        User::create([
            'display_name'    => $request->display_name,
            'username'        => $request->username,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => $request->role,
            'is_email_locked' => $request->role === 'student',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'username'     => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'        => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id), 'regex:/^[a-zA-Z0-9._%+-]+@solms\.id$/i'],
            'password'     => ['nullable', 'string', 'min:8'],
            'role'         => ['required', Rule::in(['admin', 'student'])],
        ], [
            'email.regex'  => 'Email must end with @solms.id',
        ]);

        $data = [
            'display_name'    => $request->display_name,
            'username'        => $request->username,
            'email'           => $request->email,
            'role'            => $request->role,
            'is_email_locked' => $request->role === 'student',
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->getKey() === $request->user()?->getAuthIdentifier()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
