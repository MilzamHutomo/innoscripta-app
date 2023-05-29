<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'TeamX') }}</title>
         <!-- Scripts -->
        <link rel="shortcut icon" type="image/x-icon" href="https://prium.github.io/falcon/v3.16.0/assets/img/favicons/favicon.ico">
        <meta name="theme-color" content="#ffffff">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
        />
        @vite(['resources/js/app.js'])
    </head>
    <body  class="font-Inter">
        <div id="app" class="h-full">

        </div>
    </body>
</html>
