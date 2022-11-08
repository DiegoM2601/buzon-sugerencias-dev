

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
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?ver=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css?ver=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/animation.css?ver=1.0">

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
								        {{-- <p><strong>Buzón de Sugerencias</strong></p> --}}
                                    </div>
                                    {{-- <div class="col-6" style="text-align: right;">
                                        <img src="./assets/images/logo.png" alt="">
                                    </div> --}}
                                </div>
							</div>
                                <div class="step-heading mt-4">
                                    <p class="text-center">Tu opinión es importante. Este buzón es otra vía de contacto directa que tienes con la Universidad. Está pensado para que puedas hacernos llegar tus sugerencias de manera anónima. Queremos conocer tus ideas.</p>
                                    <p class="text-center mt-3">Gracias por dedicarnos tu tiempo.</p>
                                </div>
                                <div class="container">
                                    <div class="row">
                                      <div class="col text-center">
                                        <!-- <button class="btn btn-default">Centered button</button> -->
                                        <div class="form-buttons-center text-center">
                                            <button type="button" class="next" id="btnContinuar">Continuar</i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
								<!-- next-prev-btn -->
						</div>
					</section>

                    {{-- <section class="steps-inner" id="step-1">
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
									Pregunta 1 / 4
								</span>
								<div class="step-bar-inner">
									<div class="step-bar-move step-move m25"></div>
								</div>
							</div>
								<div class="form-heading">
									Por favor, escoge tu sede:
								</div>
								<div class="form-inner pop-slide">
									<label class="form-input" for="sede">
										<input type="radio" name="sede" value="CBB">
										Cochabamba
									</label>
									<label class="form-input" for="sede">
										<input type="radio" name="sede" value="EAT">
										El Alto
									</label>
									<label class="form-input" for="sede">
										<input type="radio" name="sede" value="LPZ">
										La Paz
									</label>
									<label class="form-input" for="sede">
										<input type="radio" name="sede" value="SCZ">
										Santa Cruz
									</label>
								</div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSede" style="display: none">
                                    Por favor, escoge tu sede.
                                </div>

								<!-- next-prev-btn -->
								<div class="form-buttons">
                                    <button type="button" class="prev" id="prev-1"><i class="fa-solid fa-arrow-left"></i>Regresar</button>
									<button type="button" class="next" id="btnSede">Siguiente<i class="fa-solid fa-arrow-right"></i></button>
								</div>
						</div>
					</section> --}}

					<!-- step-2 -->
					<section class="steps-inner"  id="step-2">
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
									Pregunta 2 / 4
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
                                                <input type="radio" name="carrera" id="" value="ADM">
                                                ADM
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="AHT">
                                                AHT
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ARQ">
                                                ARQ
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="BYF">
                                                BYF
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="CPU">
                                                CPU
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="DER">
                                                DER 
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="DGP">
                                                DGP 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ENF">
                                                ENF 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ICO">
                                                ICO 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="IEC">
                                                IEC 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="IEF">
                                                IEF 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="MED">
                                                MED
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="ODO">
                                                ODO
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PER">
                                                PER
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PSI">
                                                PSI 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="PYM">
                                                PYM 
                                            </label>
                                            <label class="form-input" for="carrera">
                                                <input type="radio" name="carrera" id="" value="SIS">
                                                SIS 
                                            </label>
                                        </div>
                                    </div>
								</div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSedeCarrera" style="display: none">
                                    Error: No puedes escoger esta carrera.
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorCarrera" style="display: none">
                                    Por favor, escoge tu carrera.
                                </div>

								<!-- next-prev-btn -->
								<div class="form-buttons">
									<button type="button" class="prev" id="prev-2"><i class="fa-solid fa-arrow-left"></i>Regresar</button>
									<button type="button" class="next" id="btnCarrera">Siguiente<i class="fa-solid fa-arrow-right"></i></button>
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
									Pregunta 3 / 4
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
                                                <input type="radio" name="semestre" value="1">
                                                1
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="2">
                                                2
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="3">
                                                3
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="4">
                                                4
                                            </label>
                                            
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="5">
                                                5
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="6">
                                                6
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="7">
                                                7
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="8">
                                                8
                                            </label>
                                            
                                            
                                        </div>
                                        <div class="col-4">
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="9">
                                                9
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="10">
                                                10
                                            </label>
                                            <label class="form-input" for="semestre">
                                                <input type="radio" name="semestre" value="11">
                                                11
                                            </label>
                                        </div>
                                    </div>
								</div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSemestre" style="display: none">
                                    Por favor, escoge tu semestre.
                                </div>

								<!-- next-prev-btn -->
								<div class="form-buttons">
									<button type="button" class="prev" id="prev-3"><i class="fa-solid fa-arrow-left"></i>Regresar</button>
									<button type="button" class="next" id="btnSemestre" >Siguiente<i class="fa-solid fa-arrow-right"></i></button>
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
									Pregunta 4 / 4
								</span>
								<div class="step-bar-inner">
									<div class="step-bar-move step-move m100"></div>
								</div>
							</div>
								<div class="form-heading">
									Escoge al área al que va dirigida tu(s) sugerencia(s)
								</div>
								<div class="form-inner pop-slide">
                                    <select class="form-select" name="area" id="area">
                                        <option selected disabled>Seleccionar Área</option>
                                        @foreach ($areas as $area)
                                        <option value="{{ $area->area }}">{{ $area->area }}</option>
                                        @endforeach
                                      </select>
								</div>
                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorArea" style="display: none">
                                    Por favor, selecciona un área.
                                </div>
                                <div class="form-heading mt-4">
									Por favor, escribe tu(s) sugerencia(s)
								</div>
                                <div class="form-inner pop-slide">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="sugerencia" id="sugerencia" style="height: 100px"></textarea>
                                    </div>
                                </div>

                                <div class="alert alert-danger mt-3 pop-slide" role="alert" id="errorSugerencia" style="display: none">
                                    Por favor, rellena este campo.
                                </div>
                                
								<div class="form-buttons">
									<button type="button" class="prev" id="prev-4"><i class="fa-solid fa-arrow-left"></i>Regresar</button>
									<button type="button" class="next" id="btnSugerencia">Finalizar<i class="phone-ring fa-solid fa-thumbs-up"></i></button>
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
									<button type="button" class="next" id="btnHome">Regresar al inicio</i></button>
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
<script type="text/javascript" src="assets/js/custom.js?ver=1.0"></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



</script>

</body>
</html>