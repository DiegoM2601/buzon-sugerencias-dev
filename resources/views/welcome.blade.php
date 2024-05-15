@if ($accessGranted)
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
                                                <button type="button" class="next"
                                                    id="btnGeoContinuar">Continuar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- next-prev-btn -->
                            </div>
                        </section>
                        <section class="steps-inner pop-slide" id="geo-error">
                            <div class="wrapper">
                                <div class="step-heading">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="./assets/images/logo.png" alt="">
                                            <h2 class="mt-5">Buzón de Sugerencias</h2>
                                        </div>
                                    </div>
                                </div>
                                <h1 id="MIERDA"></h1>
                                <div class="step-heading mt-4">
                                    <p class="text-center">EL PERMISO DE ACCESO A LA UBICACIÓN FUE DENEGADO, POR FAVOR
                                        INTÉNTALO NUEVAMENTE EN <b id = "conteo">5</b></p>
                                    <div class="video-container">
                                        <img src="{{ asset('gifs/permiso-denegado.gif') }}" width="250px">
                                    </div>
                                </div>
                                <!-- next-prev-btn -->
                            </div>
                        </section>
                        <section class="steps-inner pop-slide" id="step-0">
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
                                    <p class="text-center">Tu opinión es importante. Este buzón es otra vía de contacto
                                        directa que tienes con la Universidad. Está pensado para que puedas hacernos
                                        llegar tus sugerencias de manera anónima. Queremos conocer tus ideas.</p>
                                    <p class="text-center mt-3">Gracias por dedicarnos tu tiempo.</p>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col text-center">
                                            <!-- <button class="btn btn-default">Centered button</button> -->
                                            <div class="form-buttons-center text-center">
                                                <button type="button" class="next"
                                                    id="btnContinuar">Continuar</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- next-prev-btn -->
                            </div>
                        </section>
                        <section class="steps-inner" id="step-1">
                            <div class="wrapper">
                                <div class="step-heading mb-5 title-ml">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2>UNIFRANZ</h2>
                                            <p>Buzón de Sugerencias</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <img src="./assets/images/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="step-bar">
                                    <span class="step-counter">
                                        Pregunta 2 / 5
                                    </span>
                                    <div class="step-bar-inner">
                                        <div class="step-bar-move step-move m50"></div>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    Selecciona una opción:
                                </div>
                                <div class="form-inner pop-slide">
                                    <div class="row">
                                        <div class="col-6"style="text-align: center;">
                                            <label class="form-input" for="by_">
                                                <input type="radio" name="by_" value="Estudiante"
                                                    autocomplete="off">
                                                Estudiante
                                            </label>
                                        </div>
                                        <div class="col-6"style="text-align: center;">
                                            <label class="form-input" for="by_">
                                                <input type="radio" name="by_" value="Docente"
                                                    autocomplete="off">
                                                Docente
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorBy"
                                    style="display: none">
                                    Por favor, selecciona un opción.
                                </div>
                                <div class="form-buttons">
                                    <button type="button" class="prev" id="prev-1"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                    <button type="button" class="next" id="btnBy">Siguiente<i
                                            class="fa-solid fa-arrow-right"></i></button>
                                </div>

                            </div>
                        </section>
                        <!-- step-2 -->
                        <section class="steps-inner" id="step-2">
                            <div class="wrapper">
                                <div class="step-heading mb-5 title-ml">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2>UNIFRANZ</h2>
                                            <p>Buzón de Sugerencias</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <img src="./assets/images/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="step-bar">
                                    <span class="step-counter">
                                        Pregunta 3 / 5
                                    </span>
                                    <div class="step-bar-inner">
                                        <div class="step-bar-move step-move m50"></div>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    Escoge tu carrera:
                                </div>
                                <div class="form-inner pop-slide">
                                    <div class="row">
                                        <div class="col-4">

                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ADM"
                                                    autocomplete="off">
                                                ADM
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="AHT"
                                                    autocomplete="off">
                                                AHT
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ARQ"
                                                    autocomplete="off">
                                                ARQ
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="BYF"
                                                    autocomplete="off">
                                                BYF
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="CPU"
                                                    autocomplete="off">
                                                CPU
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="DER"
                                                    autocomplete="off">
                                                DER
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="DGP"
                                                    autocomplete="off">
                                                DGP
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ENF"
                                                    autocomplete="off">
                                                ENF
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ICO"
                                                    autocomplete="off">
                                                ICO
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="IEC"
                                                    autocomplete="off">
                                                IEC
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="IEF"
                                                    autocomplete="off">
                                                IEF
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="MED"
                                                    autocomplete="off">
                                                MED
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ODO"
                                                    autocomplete="off">
                                                ODO
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PER"
                                                    autocomplete="off">
                                                PER
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PSI"
                                                    autocomplete="off">
                                                PSI
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PYM"
                                                    autocomplete="off">
                                                PYM
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="SIS"
                                                    autocomplete="off">
                                                SIS
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSedeCarrera"
                                    style="display: none">
                                    Error: No puedes escoger esta carrera.
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorCarrera"
                                    style="display: none">
                                    Por favor, escoge tu carrera.
                                </div>

                                <!-- next-prev-btn -->
                                <div class="form-buttons">
                                    <button type="button" class="prev" id="prev-2"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                    <button type="button" class="next" id="btnCarrera">Siguiente<i
                                            class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </section>

                        <!-- step-3 -->
                        <section class="steps-inner" id="step-3">
                            <div class="wrapper">
                                <div class="step-heading mb-5 title-ml">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2>UNIFRANZ</h2>
                                            <p>Buzón de Sugerencias</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <img src="./assets/images/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="step-bar">
                                    <span class="step-counter">
                                        Pregunta 4 / 5
                                    </span>
                                    <div class="step-bar-inner">
                                        <div class="step-bar-move step-move m75"></div>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    Tu semestre:
                                </div>
                                <div class="form-inner pop-slide">
                                    <div class="row">
                                        <div class="col-4">

                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="1"
                                                    autocomplete="off">
                                                1
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="2"
                                                    autocomplete="off">
                                                2
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="3"
                                                    autocomplete="off">
                                                3
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="4"
                                                    autocomplete="off">
                                                4
                                            </label>

                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="5"
                                                    autocomplete="off">
                                                5
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="6"
                                                    autocomplete="off">
                                                6
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="7"
                                                    autocomplete="off">
                                                7
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="8"
                                                    autocomplete="off">
                                                8
                                            </label>


                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="9"
                                                    autocomplete="off">
                                                9
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="10"
                                                    autocomplete="off">
                                                10
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="11"
                                                    autocomplete="off">
                                                11
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSemestre"
                                    style="display: none">
                                    Por favor, escoge tu semestre.
                                </div>

                                <!-- next-prev-btn -->
                                <div class="form-buttons">
                                    <button type="button" class="prev" id="prev-3"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                    <button type="button" class="next" id="btnSemestre">Siguiente<i
                                            class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </section>

                        <!-- step-4 -->
                        <section class="steps-inner" id="step-4">
                            <div class="wrapper">
                                <div class="step-heading mb-5 title-ml">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2>UNIFRANZ</h2>
                                            <p>Buzón de Sugerencias</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <img src="./assets/images/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="step-bar">
                                    <span class="step-counter">
                                        Pregunta 5 / 5
                                    </span>
                                    <div class="step-bar-inner">
                                        <div class="step-bar-move step-move m100"></div>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    Selecciona una opción:
                                </div>
                                <div class="form-inner pop-slide sugerencia-reclamo-ratio">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-input" for="categoria">
                                                <input type="radio" name="categoria" value="Reclamo"
                                                    autocomplete="off">
                                                Reclamo
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-input" for="categoria">
                                                <input type="radio" name="categoria" value="Sugerencia"
                                                    autocomplete="off">
                                                Sugerencia
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorCategoria"
                                    style="display: none">
                                    Por favor, seleccione una.
                                </div>
                                <div class="form-heading">
                                    Escoge al área al que va dirigida tu(s) sugerencia(s):
                                </div>
                                <div class="form-inner pop-slide">
                                    <select class="form-select" name="area" id="area">
                                        <option selected disabled>Seleccionar Área</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endforeach
                                        <option value="OTROS">OTRO</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorArea"
                                    style="display: none">
                                    Por favor, selecciona un área.
                                </div>
                                <div class="form-inner">
                                    <input class="form-control" name="newarea" id="newarea"
                                        style="display:none; line-height: 2.7"
                                        placeholder="Ingrese el nombre del área">
                                </div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="ErrorNewArea"
                                    style="display: none">
                                    Por favor, escribe el área.
                                </div>

                                <div class="form-heading mt-4">
                                    Por favor, escribe tu(s) sugerencia(s):
                                </div>
                                <div class="form-inner pop-slide">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="sugerencia" id="sugerencia" style="height: 100px" autocomplete="off"></textarea>
                                    </div>
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSugerencia"
                                    style="display: none">
                                    Por favor, rellena este campo.
                                </div>

                                <div class="form-buttons-center text-center">
                                    <button type="button" class="prev" id="prev-4"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                    <button type="button" class="next" id="btnSugerencia">Finalizar<i
                                            class="phone-ring fa-solid fa-thumbs-up"></i></button>
                                </div>
                            </div>
                        </section>

                        <section class="steps-inner" id="step-5">
                            <div class="wrapper">
                                <div class="step-heading mb-5 title-ml">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2>UNIFRANZ</h2>
                                            <p>Buzón de Sugerencias</p>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <img src="./assets/images/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="tick text-center">
                                        <div class="done-tick"></div>
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <h2 class="mt-4 pop-slide">Enviado correctamente</h2>

                                    <p class="pop-slide">
                                        ¡Gracias por ayudarnos a mejorar!
                                    </p>

                                    <!-- next-prev-btn -->
                                    <div class="form-buttons-center-ml text-center">
                                        <button type="button" class="next" id="btnHome">Regresar al
                                            inicio</i></button>
                                    </div>
                                    <div class="form-buttons-center-ml text-center">
                                        <button type="button" class="next" id="btnNuevaSugerencia">Nueva
                                            Sugerencia</i></button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        {{-- TODO: Este script es necesario para la reproducción automática? --}}
        {{-- <script>
            document.getElementById('vid').play();
        </script> --}}


        <!-- bootstrap JS -->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- custom JS -->
        <script type="text/javascript" src="assets/js/custom.js?ver=1.0.1"></script>
        <script src="{{ asset('js/geolocalizacion.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script></script>
    </body>

    </html>
@else
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
                    <img src="https://img001.prntscr.com/file/img001/ahRrXmoCSZe_wg6gieoB4A.png" alt="Error de Acceso"
                        class="error-image">
                </div>
                <div class="col-12 col-md-6 error-content order-md-1">
                    <h1>Acceso Restringido</h1>
                    <div class="mb-4">
                        <p>Por favor, conéctate al WiFi</p>
                        <p>de la universidad para utilizar</p>
                        <p>esta plataforma.</p>
                    </div>
                    <a href="{{ request()->url() }}" class="btn btn-primary">Intentar nuevamente</a>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>


@endif
