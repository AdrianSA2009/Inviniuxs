<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{  asset('styles/style_adrian.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <h1>Ini Judul Merah</h1>
    <div class="bg-blue-500 p-4 m-4 rounded-lg text-dark">Ini pakai Tailwind</div>
    <div class="flex">
        <img src="{{ asset('images/winter1.jpg') }}" alt=""><br>
        <img src="{{ asset('images/winter2.jpg') }}" alt="">
    </div>
    
</body>
</html>