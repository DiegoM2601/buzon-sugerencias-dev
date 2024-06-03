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
                                    <div class = "mt-5 recordatorio-geo">
                                        <p><i class="fas fa-map-marker-alt icono-geo"></i>
                                        </p>
                                        <div class = "txt-recordatorio-geo">
                                            <p>Recuerda que durante el
                                                llenado del
                                                siguiente formulario el GPS de tu dispositivo debe
                                                permanecer siempre activado.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col text-center">
                                            <div class="form-buttons-center text-center">
                                                <button type="button" class="next"
                                                    id="btnContinuar">Continuar</i></button>
                                            </div>
                                            <div class="form-buttons-center text-center">
                                                <button class = "prev" id = "btnAyuda">¿Necesitas ayuda?</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- next-prev-btn -->
                            </div>
                        </section>
                        <section class="steps-inner pop-slide" id="geo-load">
                            <div class="wrapper">
                                <div class="step-heading">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="./assets/images/logo.png" alt="">
                                            <h2 class="mt-5">Buzón de Sugerencias</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 text-center">
                                    {{-- <h4>SEDE LA PAZ DETECTADA</h4> --}}
                                    <h4 id = "geo-sede-detectada"></h4>
                                </div>
                                <div class="video-container" id = "geo-animacion">
                                    {{-- <img src="{{ asset('gifs/check-list.gif') }}" width="200px"> --}}
                                    <img src="{{ asset('gifs/cargando-geolocalizacion.gif') }}" width = "300px">
                                </div>
                                <div class="step-heading mt-4">
                                    <p class="text-center" id = "geo-load-msj">Por favor, aguarda mientras detectamos tu
                                        ubicación.</p>
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


        <!-- bootstrap JS -->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- custom JS -->
        <script type="text/javascript" src="assets/js/custom.js?ver=1.0.1"></script>
        {{-- <script src="{{ asset('js/sedes.js') }}" type="module"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
        <script src="{{ asset('js/sedesUnifranz.js') }}"></script>
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
