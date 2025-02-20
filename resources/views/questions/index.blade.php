<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">All Questions</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($questions as $question)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold">{{ $question->title }}</h3>
                <p class="text-gray-700">{{ $question->content }}</p>
                <p class="text-sm text-gray-500">Asked by {{ $question->user->name ?? 'Anonymous' }}</p>

                <!-- Answers Section -->
                <div class="mt-4">
                    <h4 class="font-bold">Answers:</h4>
                    @foreach ($question->answers as $answer)
                        <div class="bg-gray-200 p-2 rounded my-2">
                            <p>{{ $answer->content }}</p>
                            <span class="text-sm text-gray-600">By {{ $answer->user->name ?? 'Anonymous' }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Answer Form -->
                @auth
                    <form action="{{ route('questions.answer', $question->id) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" rows="2" class="w-full p-2 border rounded" placeholder="Write your answer..."></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Submit</button>
                    </form>
                @else
                    <p class="text-red-500 mt-3">You must be logged in to answer.</p>
                @endauth
            </div>
        @endforeach
    </div>

</body>
</html>
