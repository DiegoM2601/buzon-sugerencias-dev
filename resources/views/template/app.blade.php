<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Buzón de Sugerencias | UNIFRANZ</title>
		<meta charset="utf-8" />
		<meta name="description" content="Sistema de Transferencias Bancarias CNF" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_ES" />
		<meta property="og:title" content="Buzón de Sugerencias | UNIFRANZ" />
		<meta property="og:site_name" content="UNIFRANZ" />
		{{-- <link rel="shortcut icon" href="assets/media/logos/icon.png" /> --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{url('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

		<!-- iconic by fontawasome -->
		<script src="https://kit.fontawesome.com/5ff3d2d8e3.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		

	
	</head>
	<body style="background-image: url({{url('assets/media/patterns/header-bg.png')}})" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include('template.header')
					<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
							<div class="page-title d-flex flex-column">
								<h1 class="d-flex text-white fw-bolder fs-2qx my-1 me-5">@yield('title-content')</h1>
                                @yield('breadcrumb')
							</div>
						</div>
					</div>
					<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
						
						@yield('content-main')
						
					</div>
					@include('template.footer')
				</div>
			</div>
		</div>
		<script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{url('assets/js/scripts.bundle.js')}}"></script>
		<script src="{{url('assets/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
		<script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<script src="{{url('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{url('assets/js/custom/widgets.js')}}"></script>
		<script src="{{url('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{url('assets/js/custom/intro.js')}}"></script>
		
		
		@yield('script')
		
	</body>
</html>