<!-- resources/views/welcome.blade.php -->

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    @php

        $menuItems = [['url' => '/login', 'name' => 'Login'], ['url' => '/register', 'name' => 'Register']];
    @endphp
    <x-Nav-c :menuItems="$menuItems" />
    <div class="flex justify-center">
        <div class="max-w-3xl w-full">
            @yield('content')
        </div>
    </div>
</body>

</html>
