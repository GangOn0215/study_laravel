<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-white">

<header class="hidden md:flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400">
    <div class="flex h-full items-start w-full">
        <div class="flex items-center logo h-full w-1/6 justify-center">
            <img src="/assets/image/logo.png" alt="" srcset="" class="h-5/6">
        </div>
        <nav class="h-full w-full">
            <ul class="flex h-full items-center w-5/6 justify-evenly transition duration-300">
                <li><a href="#">About</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="/todos">Project</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Diary</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="md:hidden flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400">
    <div class="flex h-full w-full items-start justify-between">
        <div class="flex items-center logo h-full shrink-0">
            <img src="./assets/image/logo.png" alt="" srcset="" class="h-5/6">
        </div>
        <div class="flex items-center logo h-full shrink-0 px-8">
            <img src="./assets/image/hamburger.png" class="h-2/6">
        </div>
    </div>
</div>

<main class="hidden md:flex h-full">
    <aside class="bg-white h-full w-1/6 shadow-sm border border-gray-300"></aside>
    <article class="h-full w-full">
        <section class="flex h-full w-full justify-center">
            @yield('content')
        </section>
    </article>
</main>
</body>
</html>
