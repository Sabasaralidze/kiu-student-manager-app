<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->profile()->firstOrCreate(['user_id' => $user->id]);
        $user->load('profile');

        return view('profile.edit', [
            'user' => $user,
            'profile' => $user->profile,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'student_id' => $validated['student_id'] ?? null,
                'faculty' => $validated['faculty'] ?? null,
                'phone' => $validated['phone'] ?? null,
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'Profile updated.');
    }
}
