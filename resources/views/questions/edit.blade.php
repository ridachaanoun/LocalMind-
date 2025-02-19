@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Question</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $question->title) }}" class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Details</label>
                <textarea name="content" id="content" rows="4" class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>{{ old('content', $question->content) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location (Optional)</label>
                <input type="text" name="location" id="location" value="{{ old('location', $question->location) }}" class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700">Update</button>
        </form>
    </div>
@endsection
