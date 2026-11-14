<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();

        $view = $user->isAdmin()
            ? 'profile.admin-edit'
            : 'profile.edit';

        return view($view, compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        unset($validated['current_password']);

        $request->user()->update($validated);

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }
}
