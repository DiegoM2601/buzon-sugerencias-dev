<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón de Sugerencias - UNIFRANZ</title>

    <meta name="description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria.">

    <meta property="og:title" content="Buzón de Sugerencias - UNIFRANZ" />
    <meta property="og:description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria." />

    <meta name="twitter:title" content="Buzón de Sugerencias - UNIFRANZ">
    <meta name="twitter:description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria.">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://buzon-de-sugerencias.unifranz.edu.bo/assets/css/style.css?ver=1.0.1">

    <style>
        .error-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }

        .error-container h1 {
            color: #fa4729;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .error-container p {
            margin-bottom: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #fa4729;
            border: none;
            padding: 0.5rem 2rem;
            font-size: 1.3rem;
            border-radius: 1rem;
            font-weight: 600;
        }

        .btn-check:active+.btn-primary,
        .btn-check:checked+.btn-primary,
        .btn-primary.active,
        .btn-primary:active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #fa4729;
            border-color: #fa4729;
        }

        .btn-check:focus+.btn-primary,
        .btn-primary:focus {
            color: #fff;
            background-color: #F44336;
            border-color: #F44336;
            box-shadow: 0 0 0 0.2rem rgb(224 65 33 / 50%);
        }

        .btn-check:active+.btn-primary:focus,
        .btn-check:checked+.btn-primary:focus,
        .btn-primary.active:focus,
        .btn-primary:active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgb(244 67 54 / 50%);
        }

        .btn-primary:hover {
            background-color: #e04121;
        }

        .error-content {
            max-width: 400px;
            margin: auto;
        }

        .error-image {
            max-width: 100%;
            height: auto;
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1140px;
            }
        }

        /* Centrar texto en dispositivos móviles */
        @media (max-width: 768px) {
            .error-content {
                text-align: center;
            }

            .error-image {
                width: 80%;
                padding-bottom: 20px;
            }

            .error-container p {
                font-size: 20px;
            }

            .error-container h1 {
                font-size: 2.1rem;
            }

            .btn-primary {
                background-color: #fa4729;
                border: none;
                padding: 0.5rem 2rem;
                font-size: 1.15rem;
                border-radius: 1rem;
                font-weight: 600;
            }

        }

        @media (max-width: 768px) {
            .error-content {
                text-align: center;
                order: 2;
            }

            .error-image-container {
                order: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container error-container">
        <div class="row">
            <div class="col-12 col-md-6 error-image-container order-md-2 text-center">
                <img src="{{ asset('img/denegado-geo.png') }}" alt="Error de Acceso" class="error-image">
            </div>
            <div class="col-12 col-md-6 error-content order-md-1">
                {{-- @isset($gps_denegado)
                    <h1>Negaste el Permiso de Ubicación</h1>
                    <div class="mb-4">
                        <p>Por favor, debes habilitar</p>
                        <p>el permiso de Ubicación</p>
                        <p>para acceder al </p>
                        <p>formulario.</p>
                    </div>
                @else
                    <h1>Acceso Restringido</h1>
                    <div class="mb-4">
                        <p>Por favor, debes hallarte</p>
                        <p>al interior de una sede</p>
                        <p>Unifranz para acceder al </p>
                        <p>formulario.</p>
                    </div>
                @endisset --}}
                @if ($type == 'permiso')
                    <h1>Negaste el Permiso de Ubicación</h1>
                    <div class="mb-4">
                        <p>Por favor, debes habilitar</p>
                        <p>el permiso de Ubicación</p>
                        <p>para acceder al </p>
                        <p>formulario.</p>
                    </div>
                @elseif ($type == 'sede')
                    <h1>Acceso Restringido</h1>
                    <div class="mb-4">
                        <p>Por favor, debes hallarte</p>
                        <p>al interior de una sede</p>
                        <p>Unifranz para acceder al </p>
                        <p>formulario.</p>
                    </div>
                @else
                    <h1>Acceso Restringido</h1>
                    <div class="mb-4">
                        <p>No tienes autorización para</p>
                        <p>acceder al formulario.</p>
                    </div>
                @endif
                <a href="{{ route('index') }}" class="btn btn-primary">Intentar nuevamente</a>
                <a href="{{ route('help') }}" class="btn btn-primary mt-3">¿Necesitas ayuda?</a>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
