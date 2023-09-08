<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Using TinyMCE with Laravel Livewire</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.tiny.cloud/1/1d1a9ualu33c1e67ikyh5pwoqvikocr6sr3lt2vuqrfjj8pd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    @livewireStyles
</head>

<body class="bg-gray-200" style="font-family: Nunito;">


<div class="max-w-7xl mx-auto px-4 py-4 sm:py-6 lg:py-8 sm:px-6 lg:px-8 ">
    {{ $slot }}
</div>

</body>
</html>
