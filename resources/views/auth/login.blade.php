
<!DOCTYPE html>
<html lang="es">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<title>Buzón de Sugerencias | UNIFRANZ</title>
		<meta charset="utf-8" />
		<meta name="description" content="Buzón de Sugerencias | UNIFRANZ" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_ES" />
		<meta property="og:title" content="Buzón de Sugerencias | UNIFRANZ" />
		<link rel="canonical" href="https://preview.keenthemes.com/ceres-html-pro" />
		{{-- <link rel="shortcut icon" href="assets/media/logos/icon.png" /> --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="auth-bg">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/ceres-html-pro/assets/media/illustrations/dozzy-1/14.png">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						{{-- <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="/ceres-html-pro/index.html" action="#">
							<div class="text-center mb-10">
                                <div class="mb-12 mt-3">
                                    <img alt="Logo" src="assets/media/logos/logo.png" style="width: 80%;"/>
                                </div>
							</div>
							<div class="text-center">
								<a href="{{ url('login/google') }}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5" style="padding: 1.5rem;">
								<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Ingresar con Google</a>
							</div>
						</form> --}}
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Buzón de Sugerencias</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-semibold fs-4">Solo Administradores</div>
                            <!--end::Link-->
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>
    
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-8">
                                <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>
    
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-0 mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>
                        </form>

					</div>
				</div>
			</div>
		</div>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
	</body>
</html>