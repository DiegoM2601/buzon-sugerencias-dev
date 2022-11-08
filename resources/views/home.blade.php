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
<div class="content flex-row-fluid" id="kt_content">
    <div class="card card-page">
        <div class="card-body">
            <div class="row g-5 g-xl-8">
                <div class="col-xxl-12">
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-header">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Registros</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Resumen Nacional</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="{{ url('export')}}" type="button" class="btn btn-sm btn-success">
                                <span class="svg-icon svg-icon-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="currentColor"></path>
                                        <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Download Report</a>
                            </div>
                        </div>
                        <div class="card-body pt-1">
                            <div id="kt_permissions_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                   <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable no-footer" id="kt_permissions_table">
                                      <thead>
                                         <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Sede</th>
                                            <th>Carrera</th>
                                            <th>Semestre</th>
                                            <th>Área</th>
                                            <th>Sugerencia</th>
                                            <th>Fecha</th>
                                         </tr>
                                      </thead>
                                      <tbody class="fw-semibold text-gray-600">
                                        
                                            @foreach ($suggestions as $s)
                                            <tr>
                                                <td>{{ $s->sede }}</td>
                                                <td>{{ $s->carrera }}</td>
                                                <td>{{ $s->semestre }}</td>
                                                <td>{{ $s->area }}</td>
                                                <td>{{ $s->sugerencia }}</td>
                                                <td>{{ $s->created_at }}</td>
                                            </tr>
                                            @endforeach
                                            
                                         
                                      </tbody>
                                   </table>
                                   
                                </div>
                                <div class="mt-5">
                                {{ $suggestions->links() }}
                                </div>
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
