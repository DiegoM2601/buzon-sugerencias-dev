@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Inicio')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
	<li class="breadcrumb-item text-white opacity-75">
		<a href="{{url('/')}}" class="text-white text-hover-primary">Inicio</a>
	</li>
	<li class="breadcrumb-item">
		<span class="bullet bg-white opacity-75 w-5px h-2px"></span>
	</li>
	<li class="breadcrumb-item text-white opacity-75">Resumen</li>
</ul>
@endsection

@section('content-main')
<div class="content flex-row-fluid">
	<div class="card">
		<div class="card-body p-lg-17 text-center">
			<div class="mx-auto mw-600px w-100 pt-10 pb-10 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_create_account_form">
				<div class="current" data-kt-stepper-element="content">
					<div class="w-100">
						<div class="pb-10 pb-lg-15">
							<h2 class="fw-bolder text-dark">Resumen</h2>
						</div>
						<div class="fv-row fv-plugins-icon-container">
							<div class="row">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection
