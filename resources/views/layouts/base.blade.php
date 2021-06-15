<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- yeld: nome pagina -->
        <title>@yield('pageTitle')</title>

        <!-- google-font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <!-- / google-font -->

        <!-- style  -->
        <link rel="stylesheet"  href="{{ asset('css/app.css') }}">
        <!-- / style  -->
    </head>
    <body>
        <header>
            <!-- comune a tutti -->
        </header>
        <main>
            <!-- sfondo e box -->
            @yield('mainContent')
        </main>
        <footer>
            <!-- comune a tutti -->
        </footer>
    </body>
    </html>