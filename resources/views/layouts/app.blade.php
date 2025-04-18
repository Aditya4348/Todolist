<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todolist</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    @yield('konten')
    @livewireScripts
</body>
</html>