<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/1490d4417f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/common.css">

</head>
<body class="antialiased bg-white">

<header class="hidden md:flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400" id="header">
    <div class="flex h-full items-start w-full">
        <div class="flex items-center logo h-full w-1/6 justify-center">
            <a href="/" class="flex items-center h-full">
                <img src="/assets/image/logo.png" alt="" srcset="" class="h-5/6">
            </a>
        </div>
        <nav class="h-full w-full">
            <ul class="flex h-full items-center w-full justify-evenly transition duration-300">
                <li class="w-36 text-center depth-root">
                    <div class="flex h-full justify-center items-center">
                        <a href="#">About</a>
                    </div>
                </li>
                <li class="w-36 text-center depth-root">
                    <div class="flex h-full justify-center items-center">
                        <a href="#">Profile</a>
                    </div>
                </li>
                <li class="w-36 text-center depth-root relative h-full" style="position: relative;">
                    <div class="flex h-full justify-center items-center">
                        <a href="/project">Project</a>
                    </div>
                    <ul class="absolute border border-gray-300 border-t-white bg-white" style="display: none;">
                        <li class="w-36 text-center mb-2 p-2 depth-item">
                            <a href="/todos" class="flex items-center justify-start px-2">
                                <i class="fa-regular fa-square-check mr-2"></i>
                                <span>Todos</span>
                            </a>
                        </li>

                        <li class="w-36 text-center mb-2 p-2 depth-item">
                            <a href="/tiktok" class="flex items-center justify-start px-2">
                                <i class="fa-brands fa-tiktok mr-2"></i>
                                <span>tiktok</span>
                            </a>
                        </li>

                        <li class="w-36 text-center mb-2 p-2 depth-item">
                            <a href="/todos" class="flex items-center justify-start px-2">
                                <i class="fa-brands fa-instagram mr-2"></i>
                                <span>instagram</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="w-36 text-center depth-root">
                    <div class="flex h-full justify-center items-center">
                        <a href="#">Contact</a>
                    </div>
                </li>
                <li class="w-36 text-center depth-root">
                    <div class="flex h-full justify-center items-center">
                        <a href="#">Diary</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div class="md:hidden flex justify-center bg-white h-24 drop-shadow-md shadow-gray-400">
    <div class="flex h-full w-full items-start justify-between">
        <div class="flex items-center logo h-full shrink-0">
            <img src="/assets/image/logo.png" alt="" srcset="" class="h-5/6">
        </div>
        <div class="flex items-center logo h-full shrink-0 px-8">
            <img src="/assets/image/hamburger.png" class="h-2/6">
        </div>
    </div>
</div>

<main class="hidden md:flex h-full">
    <aside class="bg-white h-full w-1/6 shadow-sm border border-gray-300"></aside>
    <article class="h-full w-full">
        @yield('content')
    </article>
</main>
</body>
</html>

<script src="/assets/js/layout.js"></script>
