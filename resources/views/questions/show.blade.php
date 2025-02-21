@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Question Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Question Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img class="h-10 w-10 rounded-full" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($question->user->name) }}&background=6366f1&color=fff" 
                             alt="{{ $question->user->name }}">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $question->user->name }}</p>
                            <p class="text-sm text-gray-500">Posted {{ $question->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    @if($question->location)
                        <div class="flex items-center text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $question->location }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Question Content -->
            <div class="px-6 py-4">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $question->title }}</h1>
                <div class="mt-4 prose max-w-none text-gray-600">
                    {{ $question->content }}
                </div>
            </div>
        </div>

        <!-- Answer Form -->
        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Your Answer</h2>
                    <form action="{{ route('questions.answer', $question->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div>
                            <textarea name="content" rows="4" 
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                      placeholder="Write your answer here..."></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Post Answer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Answers Section -->
        <div class="mt-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ $question->answers->count() }} {{ Str::plural('Answer', $question->answers->count()) }}
            </h2>

            <div class="space-y-4">
                @forelse ($question->answers as $answer)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($answer->user->name) }}&background=6366f1&color=fff" 
                                         alt="{{ $answer->user->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $answer->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Answered {{ $answer->created_at->diffForHumans() }}
                                    </p>
                                    <div class="mt-2 text-gray-700">
                                        {{ $answer->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="mt-2">No answers yet. Be the first to answer this question!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection