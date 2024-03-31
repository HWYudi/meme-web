<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @notifyCss
    @vite('resources/css/app.css')
    <style>
        .notify{
            align-items: flex-start
        }
    </style>
</head>

<body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <x-notify::notify />
    @notifyJs

</body>

</html>
