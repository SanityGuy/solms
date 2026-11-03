<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->query('search', ''));
        $role = $request->query('role');

        $users = User::query()
            ->withCount('lessons')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('display_name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when(in_array($role, ['admin', 'student'], true), function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'students' => User::where('role', 'student')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats', 'search', 'role'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@solms\.id$/i'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'student'])],
        ], [
            'email.regex' => 'Email must end with @solms.id',
        ]);

        User::create([
            'display_name' => $validated['display_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_email_locked' => $validated['role'] === 'student',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id), 'regex:/^[a-zA-Z0-9._%+-]+@solms\.id$/i'],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'student'])],
        ], [
            'email.regex' => 'Email must end with @solms.id',
        ]);

        if ($user->role === 'admin' && $validated['role'] !== 'admin') {
            if (User::where('role', 'admin')->count() <= 1) {
                return back()
                    ->withInput()
                    ->with('error', 'You cannot remove the last administrator.');
            }
        }

        if ($user->id === $request->user()->id && $validated['role'] !== 'admin') {
            return back()
                ->withInput()
                ->with('error', 'You cannot change your own administrator role.');
        }

        $data = [
            'display_name' => $validated['display_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'is_email_locked' => $validated['role'] === 'student',
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'You cannot delete the last administrator.');
        }

        DB::transaction(function () use ($user, $request) {
            Lesson::where('created_by', $user->id)
                ->update(['created_by' => $request->user()->id]);

            $user->delete();
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully. Their lessons were preserved.');
    }
}
