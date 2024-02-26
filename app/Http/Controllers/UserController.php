<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    public function edit(User $user)
    {
        $editing = true;
        $ideas = $user->ideas()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:240',
            'bio' => 'nullable|min:1|max:240',
            'image' => 'image'
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('users.show', $user)->with('success', 'Profile updated successfully');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
