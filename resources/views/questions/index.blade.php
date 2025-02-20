@extends('layouts.app')

@section('title', 'All Questions')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">All Questions</h1>

        @foreach($questions as $question)
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold text-blue-600">{{ $question->title }}</h2>
                <p class="text-gray-700">{{ Str::limit($question->content, 150) }}</p>
                <a href="{{ route('questions.show', $question->id) }}" class="text-blue-500 hover:underline">Read More</a>
            </div>
        @endforeach
    </div>
@endsection
