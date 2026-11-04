<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SoLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100">

    <main class="relative flex min-h-screen items-center justify-center overflow-hidden bg-cover bg-center px-4 py-10"
        style="background-image: url('{{ asset('images/solms.jpg') }}')">

        <div class="absolute inset-0 bg-white/65 backdrop-blur-[3px]"></div>

        <div class="relative z-10 w-full max-w-md">
            <div
                class="rounded-3xl border border-white/70 bg-white/95 p-8 shadow-2xl shadow-blue-900/10 backdrop-blur-xl sm:p-10">

                <div class="mb-8 text-center">
                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-2xl font-black text-white shadow-lg shadow-blue-600/20">
                        S
                    </div>

                    <h1 class="mt-5 text-3xl font-bold tracking-tight text-slate-900">
                        Welcome back
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Sign in to continue to SoLMS.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                            Username or Email
                        </label>

                        <input id="email" name="email" type="text" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="Enter your username or email"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label for="password" class="text-sm font-semibold text-slate-700">
                                Password
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                    </div>

                    <label class="flex cursor-pointer items-center gap-2.5">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-600">Remember me</span>
                    </label>

                    <button type="submit"
                        class="w-full rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-blue-600/30 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                        Sign In
                    </button>
                </form>

                <div class="my-7 border-t border-slate-100"></div>

                <div class="text-center">
                    <p class="text-sm font-medium text-slate-700">
                        Don't have an account?
                    </p>
                    <p class="mt-1 text-sm leading-relaxed text-slate-500">
                        Account registration is managed by the school.
                        Please contact your administrator to request an account.
                    </p>
                </div>
            </div>

            <p class="mt-6 text-center text-xs font-medium text-slate-600">
                © {{ date('Y') }} SoLMS. All rights reserved.
            </p>
        </div>
    </main>

</body>

</html>