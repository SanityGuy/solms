<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $request->user()->update($request->validated());

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'You cannot delete the last administrator.');
        }

        $replacementAdmin = User::where('role', 'admin')
            ->where('id', '!=', $user->id)
            ->first();

        $hasLessons = Lesson::where('created_by', $user->id)->exists();

        if ($hasLessons && !$replacementAdmin) {
            return back()->with('error', 'No administrator is available to take ownership of your lessons.');
        }

        DB::transaction(function () use ($user, $replacementAdmin) {
            if ($replacementAdmin) {
                Lesson::where('created_by', $user->id)
                    ->update(['created_by' => $replacementAdmin->id]);
            }

            $user->delete();
        });

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
