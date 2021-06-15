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
        <div id="root">
            <header>
                <div class="container-fluid">
                    <div class="row flex-center">
                        <div class="col-2">
                            <a href="#" id="logo"><i class="fab fa-airbnb"></i></a>
                        </div>
                        <div class="col-10 text-right">
                            <a href="#" class="my-btn my-btn-secondary align-bottom"><i class="fas fa-user"></i><span class="d-none d-md-inline-block">Nome Utente</span></a>
                            <a href="#" class="my-btn my-btn-primary"><i class="fas fa-sign-out-alt"></i><span class="d-none d-md-inline-block">Log-out</span></a>
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
                            <a href="#" id="logo"><i class="fab fa-airbnb"></i> © 2021 Airbnb, Inc.</a>
                        </div>
                        <div class="col-6 text-right social-list">
                            <a href="#" id="logo"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" id="logo"><i class="fab fa-instagram"></i></i></a>
                            <a href="#" id="logo"><i class="fab fa-twitter"></i></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>