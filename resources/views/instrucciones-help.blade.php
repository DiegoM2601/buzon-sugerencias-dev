<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buzón de Sugerencias - UNIFRANZ</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <!-- Font awesome 6 -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">

    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?ver=1.0.1">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css?ver=1.0.1">
    <link rel="stylesheet" type="text/css" href="assets/css/animation.css?ver=1.0.1">
    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">

    <meta name="description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria.">

    <meta property="og:title" content="Buzón de Sugerencias - UNIFRANZ" />
    <meta property="og:description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria." />

    <meta name="twitter:title" content="Buzón de Sugerencias - UNIFRANZ">
    <meta name="twitter:description"
        content="Plataforma diseñada para que los estudiantes de UNIFRANZ puedan hacer sugerencias o reclamos de forma anónima, proporcionando un espacio seguro para compartir opiniones y mejorar la experiencia universitaria.">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="show-section">

    <section class="steps" id="steps">
        <div class="container">
            <div class="mx-auto col-md-12 col-lg-7">
                <!-- step-1 -->
                <div class="show-section">
                    <section class="steps-inner pop-slide" id="geo-0">
                        <div class="wrapper">
                            <div class="step-heading">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="./assets/images/logo.png" alt="">
                                        <h2 class="mt-5">Buzón de Sugerencias</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="step-heading mt-4">
                                <p class="text-center">Antes de acceder al formulario,
                                    necesitamos que enciendas el
                                    GPS de tu dispositivo móvil. Por favor, sigue cuidadosamente los siguientes
                                    pasos: </p>
                                <p class = "mt-5"><span class="step">1</span>Dirígete al panel de
                                    notificaciones y
                                    activa la
                                    opción de Ubicación.</p>
                                <div class = "video-container mt-5">
                                    <video width="300" height="510" autoplay loop muted>
                                        <source src="{{ asset('videos/1.mp4') }}" type="video/mp4">
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                                <p class = "mt-5"><span class="step">2</span>Una vez que accedas al formulario
                                    debes dar
                                    permiso al navegador para acceder a tu ubicación.</p>
                                <div class="video-container mt-5">
                                    <video width="300" height="510" autoplay loop muted>
                                        <source src="{{ asset('videos/2.mp4') }}" type="video/mp4">
                                        <!-- Fallback para navegadores que no soportan el elemento <video> -->
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                                <p class = "mt-5"><span class="step">3</span>A continuación, la aplicación debe
                                    ser capaz de
                                    acceder a tu ubicación precisa.</p>
                                <div class="video-container mt-5">
                                    <video width="300" height="510" autoplay loop muted>
                                        <source src="{{ asset('videos/3.mp4') }}" type="video/mp4">
                                        <!-- Fallback para navegadores que no soportan el elemento <video> -->
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                                <p class = "mt-5"><span class="step">i</span>Por favor, ten en cuenta que la
                                    opción de
                                    Ubicación debe mantenerse activada en todo momento. Una vez completado el
                                    formulario, puedes volver a deshabilitar dicha opción en tu dispositivo móvil.
                                </p>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col text-center">
                                        <!-- <button class="btn btn-default">Centered button</button> -->
                                        <div class="form-buttons-center text-center">
                                            <button type="button" class="next" id="btnFormulario">IR AL
                                                FORMULARIO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- next-prev-btn -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- bootstrap JS -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("#btnFormulario").click(function() {
            window.location.href = "/";
        });
    </script>
    <script></script>
</body>

</html>
