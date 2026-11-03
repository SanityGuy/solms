@extends('layouts.admin')

@section('title', 'Manage Users')
@section('heading', 'Manage Users')

@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-blue-400">Administration</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-white sm:text-3xl">User management</h1>
            <p class="mt-2 text-sm text-slate-400">Manage student and administrator accounts.</p>
        </div>

        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
            + Create user
        </a>
    </div>

    <div class="mb-6 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Total accounts</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ number_format($stats['total']) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Students</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ number_format($stats['students']) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Administrators</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ number_format($stats['admins']) }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 p-5">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col gap-3 sm:flex-row">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search name, username or email..."
                    class="min-w-0 flex-1 rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">

                <select name="role"
                    class="rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-blue-500 focus:outline-none">
                    <option value="">All roles</option>
                    <option value="student" @selected($role === 'student')>Students</option>
                    <option value="admin" @selected($role === 'admin')>Administrators</option>
                </select>

                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
                    Search
                </button>

                @if ($search || $role)
                    <a href="{{ route('admin.users.index') }}"
                        class="rounded-xl border border-slate-700 px-5 py-3 text-center text-sm font-medium text-slate-300 hover:bg-slate-800">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left">
                <thead class="bg-slate-950/60 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Account</th>
                        <th class="px-5 py-4 font-semibold">Username</th>
                        <th class="px-5 py-4 font-semibold">Role</th>
                        <th class="px-5 py-4 font-semibold">Lessons</th>
                        <th class="px-5 py-4 font-semibold">Email status</th>
                        <th class="px-5 py-4 text-right font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-slate-800/30">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500/10 font-semibold text-blue-400">
                                        {{ strtoupper(substr($user->display_name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-white">{{ $user->display_name }}</p>
                                        <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-300">{{ '@' . $user->username }}</td>

                            <td class="px-5 py-4">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-blue-500/10 text-blue-400' : 'bg-slate-800 text-slate-300' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-300">{{ $user->lessons_count }}</td>

                            <td class="px-5 py-4">
                                @if ($user->is_email_locked)
                                    <span class="text-xs font-medium text-amber-400">Locked</span>
                                @else
                                    <span class="text-xs font-medium text-emerald-400">Unlocked</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="text-sm font-medium text-blue-400 hover:text-blue-300">
                                        Edit
                                    </a>

                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Delete this account? Any lessons created by this user will be preserved and reassigned to you.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-400 hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <p class="font-semibold text-white">No users found</p>
                                <p class="mt-1 text-sm text-slate-500">Try changing your search or filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-800 px-5 py-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection