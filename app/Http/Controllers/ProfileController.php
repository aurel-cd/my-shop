<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $fullname = $request->name;
        $nameParts = explode(" ", $fullname);

        // Get the first name (index 0)
        $firstName = $nameParts[0];

        // Get the last name (index 1)
        $lastName = $nameParts[1];

        $user = $request->user();
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if (Hash::check($request['password'], $user->password)) {
            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Optionally, you can add a flash message to indicate successful deletion
            $request->session()->flash('success', 'Your account has been successfully deleted.');

            return Redirect::to('/');
        }

        // If the password doesn't match, you can add an error message
        $errors = ['password' => __('The provided password is incorrect.')];

        return redirect()->back()->withErrors($errors, 'userDeletion');
    }
}
