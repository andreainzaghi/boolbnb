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
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <!-- style  -->
        @yield('styles')
        <link rel="stylesheet"  href="{{ asset('css/app.css') }}">
        <!-- / style  -->
    </head>
    <body>
        <div id="root">
            <header>
                <div class="container-fluid">
                    <div class="row flex-center">
                        <div class="col-2">
                            <a href="{{ route('welcome') }}" id="logo"><img src="{{ asset('img/logo-name.png') }}" alt="logo"></a>
                        </div>
                        <div class="col-10 text-right">
                            @if (Route::has('login'))
                                <div>
                                    @auth
                                        <a href="{{ route('admin.apartments.index') }}" class="my-btn my-btn-secondary align-bottom"><i class="fas fa-home"></i><span class="d-none d-md-inline-block">Dashboard</span></a>
                                        <a href="/logout" class="my-btn my-btn-primary"><i class="fas fa-sign-out-alt"></i><span class="d-none d-md-inline-block">Log-out</span></a>                        
                                    @else
                                        <a href="{{ route('login') }}" class="my-btn my-btn-primary"><i class="fas fa-sign-out-alt"></i><span class="d-none d-md-inline-block">Log-in</span></a>                        
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="my-btn my-btn-primary"><i class="fas fa-sign-in-alt"></i><span class="d-none d-md-inline-block">Registrati</span></a>
                                    @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <div class="container">
                    @yield('mainLay')
                </div>
            </main>
            <footer>
                <div class="container-fluid">
                    <div class="row flex-center">
                        <div class="col-6">
                            <a href="{{ route('admin.apartments.index') }}" id="logo"> © 2021 Boolbnb, Inc.</a>
                        </div>
                        <div class="col-6 text-right social-list">
                            <a href="https://www.facebook.com/AirbnbItalia" id="logo"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/airbnb/" id="logo"><i class="fab fa-instagram"></i></i></a>
                            <a href="https://twitter.com/airbnb_it" id="logo"><i class="fab fa-twitter"></i></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @yield('script')
    </body>
</html>