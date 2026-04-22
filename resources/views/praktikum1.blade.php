<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('styles/styles_cindo.css') }}">
</head>
<body>
    <div>
        <h1>Ini Judul Merah</h1>
        <div class="bg-blue-500 p-4 m-4 rounded-lg text-white">
            Ini pakai Tailwind
        </div>
        <img src="{{ asset('images/mountain2.jpg') }}" alt="">
        <img src="{{ asset('images/mountain1.jpg') }}" alt=""><!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    </div>

</body>
</html>

