<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'nullable|string|max:255',
        ]);

        Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'user_id' => Auth::id(), // Store the authenticated user's ID
        ]);

        return redirect()->route('questions.index')->with('success', 'Question added successfully!');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'nullable|string|max:255',
        ]);

        $question->update([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }
}
