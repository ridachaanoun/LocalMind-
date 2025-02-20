@extends('layouts.app')

@section('title', 'View Question')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800">{{ $question->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $question->content }}</p>

        @if ($question->location)
            <p class="text-sm text-gray-500 mt-2"><strong>Location:</strong> {{ $question->location }}</p>
        @endif

        <p class="text-sm text-gray-500 mt-4">Asked by: <strong>{{ $question->user->name }}</strong> on {{ $question->created_at->format('d M Y') }}</p>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('questions.edit', $question->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit</a>

            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
@endsection
