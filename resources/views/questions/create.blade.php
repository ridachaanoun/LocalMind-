@extends('layouts.app')

@section('title', 'Ask a Question')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-xl font-semibold text-gray-900">Ask a Question</h1>
                <p class="mt-1 text-sm text-gray-500">Get help from the community by asking a clear, detailed question.</p>
            </div>

            @if ($errors->any())
                <div class="mx-6 mt-4">
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('questions.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Question Title</label>
                    <p class="mt-1 text-sm text-gray-500">Be specific and imagine you're asking a question to another person.</p>
                    <input type="text" name="title" id="title" 
                           class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="e.g., How do I implement authentication in Laravel?" 
                           value="{{ old('title') }}" required>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Question Details</label>
                    <p class="mt-1 text-sm text-gray-500">Include all the information someone would need to answer your question.</p>
                    <textarea name="content" id="content" rows="6" 
                              class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              placeholder="Describe what you've tried and what you're trying to achieve..." 
                              required>{{ old('content') }}</textarea>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <p class="mt-1 text-sm text-gray-500">Help others find location-specific questions (optional).</p>
                    <input type="text" name="location" id="location" 
                           class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="e.g., San Francisco, CA" 
                           value="{{ old('location') }}">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Post Your Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection