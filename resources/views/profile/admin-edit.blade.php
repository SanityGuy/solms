@extends('layouts.admin')

@section('heading', 'Account Settings')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Account Settings</h1>
            <p class="mt-1 text-sm text-slate-400">Manage your administrator account and security.</p>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-400">
                Profile updated successfully.
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-700 bg-slate-900 p-6">
                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500/10 text-xl font-bold text-blue-400">
                    {{ strtoupper(substr($user->display_name, 0, 1)) }}
                </div>

                <h2 class="mt-4 text-lg font-semibold text-white">{{ $user->display_name }}</h2>
                <p class="text-sm text-slate-400">{{ '@' . $user->username }}</p>

                <span
                    class="mt-4 inline-flex rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-400">
                    Administrator
                </span>

                <div class="mt-6 space-y-3 border-t border-slate-700 pt-5 text-sm">
                    <div class="flex justify-between gap-3">
                        <span class="text-slate-400">Account ID</span>
                        <span class="text-slate-200">#{{ $user->id }}</span>
                    </div>

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-400">Joined</span>
                        <span class="text-slate-200">{{ $user->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-400">Email</span>
                        <span class="max-w-36 truncate text-slate-200">{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                <section class="rounded-2xl border border-slate-700 bg-slate-900 p-6">
                    <h2 class="text-lg font-semibold text-white">Personal Information</h2>
                    <p class="mt-1 text-sm text-slate-400">Update your administrator profile.</p>

                    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="display_name" class="mb-2 block text-sm font-medium text-slate-300">Display
                                Name</label>
                            <input id="display_name" name="display_name"
                                value="{{ old('display_name', $user->display_name) }}" required
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
                            @error('display_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="username" class="mb-2 block text-sm font-medium text-slate-300">Username</label>
                            <input id="username" name="username" value="{{ old('username', $user->username) }}" required
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
                            @error('username')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-300">Email Address</label>
                            <input value="{{ $user->email }}" disabled
                                class="w-full cursor-not-allowed rounded-xl border border-slate-700 bg-slate-800/50 px-4 py-3 text-sm text-slate-500">
                            <p class="mt-2 text-xs text-slate-500">Contact another administrator to change your email.</p>
                        </div>

                        <button type="submit"
                            class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
                            Save Changes
                        </button>
                    </form>
                </section>

                <section class="rounded-2xl border border-slate-700 bg-slate-900 p-6">
                    <h2 class="text-lg font-semibold text-white">Security</h2>
                    <p class="mt-1 text-sm text-slate-400">Change your account password.</p>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="current_password" class="mb-2 block text-sm font-medium text-slate-300">Current
                                Password</label>
                            <input id="current_password" name="current_password" type="password" required
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-slate-300">New Password</label>
                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-300">Confirm
                                New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
                        </div>

                        <button type="submit"
                            class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
                            Update Password
                        </button>
                    </form>
                </section>

                <section class="rounded-2xl border border-red-500/20 bg-slate-900 p-6">
                    <h2 class="text-lg font-semibold text-red-400">Danger Zone</h2>
                    <p class="mt-1 text-sm text-slate-400">Permanently delete your administrator account.</p>

                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-5 space-y-4">
                        @csrf
                        @method('DELETE')

                        <div>
                            <label for="delete_password" class="mb-2 block text-sm font-medium text-slate-300">Confirm
                                Password</label>
                            <input id="delete_password" name="password" type="password" required
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-slate-700 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-red-500">
                            @error('password', 'userDeletion')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            onclick="return confirm('Are you sure you want to permanently delete your account?')"
                            class="rounded-xl border border-red-500/30 px-5 py-3 text-sm font-semibold text-red-400 transition hover:bg-red-500/10">
                            Delete Administrator Account
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection