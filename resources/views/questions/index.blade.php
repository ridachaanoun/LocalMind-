@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Community Questions</h1>
                <p class="mt-2 text-gray-600">Explore questions from your local community</p>
            </div>
            <a href="{{ route('questions.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ask Question
            </a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('questions.index') }}">
    <input type="text" name="search" placeholder="Search by keyword or location..."
           value="{{ request('search') }}"
           class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
    
    <!-- Hidden fields to send user's coordinates -->
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">

    <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        Search
    </button>
</form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Questions List -->
        <div class="space-y-6">
            @foreach($questions as $question)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="p-6">
                        <!-- Question Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 hover:text-indigo-600">
                                    <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                                </h2>
                                <div class="flex items-center mt-2 space-x-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $question->user->name }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $question->created_at->diffForHumans() }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $question->location }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Favorite Button -->
                            <div>
                                @if($question->favorites->where('user_id', auth()->id())->count())
                                    <form action="{{ route('favorites.destroy', $question->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-600 transition">
                                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorites.store', $question->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-gray-400 hover:text-red-500 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Question Content -->
                        <p class="text-gray-600 mb-4">{{ $question->content }}</p>

                        <!-- Answer Form -->
                        <div class="mt-6 border-t pt-4">
                            <form action="{{ route('questions.answer', $question->id) }}" method="POST" 
                                  class="flex items-center space-x-3">
                                @csrf
                                <input type="text" name="content" 
                                       class="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" 
                                       placeholder="Add your answer...">
                                <button type="submit" 
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                    Answer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $questions->links() }}
        </div>
    </div>
</div>
@endsection