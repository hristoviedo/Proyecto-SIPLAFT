<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
        <title>SIPLAFT</title>

        <!-- Fonts -->

        {{-- <!-- Styles -->
        <style>
            html, body {
                background-color:#70767c;
                color: #FF7F10;
                font-family:sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 94vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #FF7F10;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .img-logo {
                width:20%;
            }
        </style> --}}
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">INICIO</a>
                    @else
                        <a href="{{ route('login') }}">INICIAR SESIÓN</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">REGISTRARSE</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid img-logo" alt="Responsive image">
                <div class="title">
                    <strong>SIPLAFT</strong>
                </div>
                <p><strong>Sistema Informático para la Prevención del Lavado de Activos y Financiación Terrorista</strong></p>
                <br>
                <br>
                <div class="links">
                    <a href="https://laravel.com/docs">Documentación</a>
                    <a href="http://pplaft.cnbs.gob.hn/wp-content/uploads/2015/05/LEY-PARA-LA-REGULACION-DE-ACTIVIDADES-Y-PROFESIONES-NO-FINANCIERAS-DESIGNADAS-APNFD-Decreto-No.-131-2014.pdf">Ley de Regulación de APNFD</a>
                    <a href="https://www.cnbs.gob.hn">CNBS</a>
                    <a href="http://urmoprelaft.cnbs.gob.hn">URMOPRELAFT</a>
                    <a href="https://github.com/hristoviedo/Proyecto-SIPLAFT">Repositorio</a>
                </div>
            </div>
        </div>
        <div>
            <footer class="footer mt-auto py-3">
                <div id="copyright"><small class="">Copyright&copy; 2019 - SIPLAFT - Todos los derechos reservados</small></div>
            </footer>
        </div>
    </body>
</html>
