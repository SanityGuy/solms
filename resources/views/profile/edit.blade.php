@extends('layouts.student')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Account Settings</h1>
            <p class="mt-1 text-sm text-slate-500">Manage your profile, security, and account preferences.</p>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') === 'profile-updated' ? 'Profile updated successfully.' : 'Changes saved successfully.' }}
            </div>
        @endif

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-900">Profile Information</h2>
                <p class="mt-1 text-sm text-slate-500">Update your personal account information.</p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')

                <div>
                    <label for="display_name" class="mb-2 block text-sm font-medium text-slate-700">Display Name</label>
                    <input id="display_name" name="display_name" type="text"
                        value="{{ old('display_name', $user->display_name) }}" required maxlength="255"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('display_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="mb-2 block text-sm font-medium text-slate-700">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email Address</label>
                    <input id="email" type="email" value="{{ $user->email }}" disabled
                        class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500">
                    <p class="mt-2 text-xs text-slate-500">Email addresses are managed by your administrator.</p>
                </div>

                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Save Changes
                </button>
            </form>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-900">Password & Security</h2>
                <p class="mt-1 text-sm text-slate-500">Keep your account secure with a strong password.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="mb-2 block text-sm font-medium text-slate-700">Current
                        Password</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">New Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Confirm New
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Update Password
                </button>
            </form>
        </section>

        <section class="rounded-2xl border border-red-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-lg font-semibold text-red-700">Delete Account</h2>
                <p class="mt-1 text-sm text-slate-500">Permanently delete your account. This action cannot be undone.</p>
            </div>

            <button type="button" onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                class="rounded-xl border border-red-200 px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                Delete Account
            </button>
        </section>
    </div>

    <div id="delete-account-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 p-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <h2 class="text-lg font-bold text-slate-900">Delete your account?</h2>
            <p class="mt-2 text-sm text-slate-500">This action is permanent. Enter your password to confirm.</p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label for="delete_password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                    <input id="delete_password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                        class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                        Confirm Deletion
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection