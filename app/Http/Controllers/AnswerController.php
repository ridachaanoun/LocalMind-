<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $question = Question::findOrFail($id);

        Answer::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'question_id' => $question->id,
        ]);

        return redirect()->back()->with('success', 'Your answer has been added!');
    }
}
