<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    @include('layouts.includes.head')
</head>
<body>
<div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>

    @include('layouts.includes.sidebar')

    <div class="flex flex-col flex-1 w-full">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
            @include('layouts.includes.topbar')
        </header>
        <main class="h-full overflow-y-auto">

            @include('layouts.includes.flash-message')
            @yield('content')

        </main>
    </div>
</div>
</body>
</html>
