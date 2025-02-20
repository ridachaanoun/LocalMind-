<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('questions.index') }}" class="text-xl font-semibold">MyApp</a>
            <div>
                @auth
                    <a href="{{ route('questions.create') }}" class="px-4 py-2 bg-white text-blue-600 rounded-md shadow-md hover:bg-gray-200">Ask a Question</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 ml-2 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-white text-blue-600 rounded-md shadow-md hover:bg-gray-200">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 ml-2 bg-green-600 text-white rounded-md shadow-md hover:bg-green-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-6 p-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center p-3 mt-10">
        &copy; {{ date('Y') }} MyApp - All Rights Reserved
    </footer>

</body>
</html>
