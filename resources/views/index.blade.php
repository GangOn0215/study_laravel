<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--        @vite('resources/css/app.css')--}}
        <script src="https://cdn.tailwindcss.com"></script>
    <title>Laravel</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-white">

    <div class="hidden md:flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400">
        <div class="flex h-full items-start w-full">
            <div class="flex items-center logo h-full shrink-0">
                <img src="assets/image/logo.png" alt="" srcset="" class="h-5/6">
            </div>
            <nav class="h-full w-full">
                <ul class="flex h-full items-center w-5/6 justify-evenly transition duration-300">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="/project">Project</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Diary</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="md:hidden flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400">
        <div class="flex h-full w-full items-start justify-between">
            <div class="flex items-center logo h-full shrink-0">
                <img src="assets/image/logo.png" alt="" srcset="" class="h-5/6">
            </div>
            <div class="flex items-center logo h-full shrink-0 px-8">
                <img src="assets/image/hamburger.png" class="h-2/6">
            </div>
        </div>
    </div>
</body>
</html>
