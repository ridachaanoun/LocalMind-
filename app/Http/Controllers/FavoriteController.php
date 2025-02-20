<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Store a favorite for a question.
     */
    public function store($questionId)
    {
        $user = Auth::user();

        // Check if the question is already favorited
        if (Favorite::where('user_id', $user->id)->where('question_id', $questionId)->exists()) {
            return back()->with('error', 'You have already favorited this question.');
        }

        Favorite::create([
            'user_id' => $user->id,
            'question_id' => $questionId,
        ]);

        return back()->with('success', 'Question added to favorites.');
    }

    /**
     * Remove a favorite from a question.
     */
    public function destroy($questionId)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)->where('question_id', $questionId)->delete();

        return back()->with('success', 'Question removed from favorites.');
    }
}
