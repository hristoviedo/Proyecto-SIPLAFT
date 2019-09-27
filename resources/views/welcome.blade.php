<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <title>SIPLAFT</title>
    </head>
    <body class="body">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" class="border border-primary">INICIO</a>
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
                    <a href="#" target="_blank">Documentación</a>
                    <a href="http://pplaft.cnbs.gob.hn/wp-content/uploads/2015/05/LEY-PARA-LA-REGULACION-DE-ACTIVIDADES-Y-PROFESIONES-NO-FINANCIERAS-DESIGNADAS-APNFD-Decreto-No.-131-2014.pdf" target="_blank">Ley de Regulación de APNFD</a>
                    <a href="https://www.cnbs.gob.hn" target="_blank">CNBS</a>
                    <a href="http://urmoprelaft.cnbs.gob.hn" target="_blank">URMOPRELAFT</a>
                    <a href="https://github.com/hristoviedo/Proyecto-SIPLAFT" target="_blank">Repositorio</a>
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
