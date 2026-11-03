<div class="space-y-5">
    <div>
        <label for="display_name" class="mb-2 block text-sm font-medium text-slate-300">Display name</label>
        <input id="display_name" name="display_name" type="text" value="{{ old('display_name', $user?->display_name) }}"
            required maxlength="255"
            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-blue-500"
            placeholder="John Doe">
        @error('display_name')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="username" class="mb-2 block text-sm font-medium text-slate-300">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username', $user?->username) }}" required
            maxlength="255"
            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-blue-500"
            placeholder="johndoe">
        @error('username')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-medium text-slate-300">School email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user?->email) }}" required maxlength="255"
            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-blue-500"
            placeholder="user@solms.id">
        <p class="mt-2 text-xs text-slate-500">Only @solms.id addresses are accepted.</p>
        @error('email')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="mb-2 block text-sm font-medium text-slate-300">
            {{ $user ? 'New password' : 'Password' }}
        </label>
        <input id="password" name="password" type="password" {{ $user ? '' : 'required' }} minlength="8"
            autocomplete="new-password"
            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-blue-500"
            placeholder="{{ $user ? 'Leave blank to keep current password' : 'At least 8 characters' }}">
        @error('password')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="mb-2 block text-sm font-medium text-slate-300">Account role</label>
        <select id="role" name="role" required
            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-blue-500">
            <option value="student" @selected(old('role', $user?->role ?? 'student') === 'student')>Student</option>
            <option value="admin" @selected(old('role', $user?->role ?? 'student') === 'admin')>Administrator</option>
        </select>
        @error('role')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>