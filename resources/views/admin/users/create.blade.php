<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-100 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 p-6 rounded-lg">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="display_name" value="Display Name" />
                        <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full"
                            :value="old('display_name')" required />
                        <x-input-error :messages="$errors->get('display_name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="username" value="Username" />
                        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                            :value="old('username')" required />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="Email (@solms.id required)" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            placeholder="user@solms.id" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                            required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="role" value="Role" />
                        <select id="role" name="role"
                            class="mt-1 block w-full bg-slate-950 border-slate-700 text-slate-100 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="text-slate-400 hover:text-slate-200 text-sm">Cancel</a>
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">Create Account</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>