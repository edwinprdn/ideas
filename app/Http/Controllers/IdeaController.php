<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {

        return view('ideas.show', compact('idea'));
    }

    public function store()
    {
        $validation = request()->validate(
            [
            'content' => 'required|min:5|max:240',
            ]
        );

        $validation['user_id'] = auth()->id();
        
        Idea::create($validation);

        return redirect()->route('dashboard')->with('success', 'Idea was created successfully!');
    }

    public function edit(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) {
            abort(404, 'You are not allowed to edit this idea');
        }

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) {
            abort(404, 'You are not allowed to updatew this idea');
        }

        $validation = request()->validate(
            [
            'content' => 'required|min:5|max:240',
            ]
        );

        $idea->update($validation);

        return redirect()->route('ideas.show', $idea)->with('success', 'Idea was updated successfully!');
    }

    public function destroy(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) {
            abort(404, 'You are not allowed to delete this idea');
        }

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }
}
