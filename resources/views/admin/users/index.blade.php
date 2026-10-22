<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-100 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium">
                + Add New User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-blue-900/50 border border-blue-500 text-blue-200 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-900/50 border border-red-500 text-red-200 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800 text-slate-400 text-sm">
                                <th class="p-3">Display Name</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Role</th>
                                <th class="p-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="p-3 font-medium">{{ $user->display_name }}</td>
                                    <td class="p-3 text-slate-300">{{ $user->username }}</td>
                                    <td class="p-3 text-slate-400">{{ $user->email }}</td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded {{ $user->role === 'admin' ? 'bg-blue-900 text-blue-300 border border-blue-700' : 'bg-slate-800 text-slate-300' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-right space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="text-blue-400 hover:text-blue-300 text-sm font-medium">Edit</a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-400 hover:text-red-300 text-sm font-medium">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>