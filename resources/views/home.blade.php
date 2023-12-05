@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Sugerencias')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
	<li class="breadcrumb-item text-white opacity-75">
		<a href="{{url('/')}}" class="text-white text-hover-primary">Sugerencias</a>
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
                                <button href="{{ url('export')}}" type="button" class="btn btn-sm btn-success" id="button_download" name="button_download">
                                <span class="svg-icon svg-icon-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="currentColor"></path>
                                        <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Download Report</button>
                            </div>
                        </div>
                        
                        <form href="" method="get">
                            @csrf
                            <div class="table-responsive">
                                <table class="table gs-7 gy-7 gx-7">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <th>
                                                Sede
                                                <select type="search" name="search_sede" id="search_sede" class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Todos</option>
                                                    <option value="LPZ" {{ (old('search_sede', $searchParams['sede']) == 'LPZ') ? 'selected' : '' }}>La Paz</option>
                                                    <option value="SCZ" {{ (old('search_sede', $searchParams['sede']) == 'SCZ') ? 'selected' : '' }}>Santa Cruz</option>
                                                    <option value="CBB" {{ (old('search_sede', $searchParams['sede']) == 'CBB') ? 'selected' : '' }}>Cochabamba</option>
                                                    <option value="EAT" {{ (old('search_sede', $searchParams['sede']) == 'EAT') ? 'selected' : '' }}>El Alto</option>     
                                                </select>
                                            </th>
                                            <th>
                                                Semestre
                                                <select type="search" name="search_semestre" id="search_semestre" class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0" >Todos</option>
                                                    <option value="1" {{ (old('search_sede', $searchParams['semestre']) == '1') ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ (old('search_sede', $searchParams['semestre']) == '2') ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ (old('search_sede', $searchParams['semestre']) == '3') ? 'selected' : '' }}>3</option>
                                                    <option value="4" {{ (old('search_sede', $searchParams['semestre']) == '4') ? 'selected' : '' }}>4</option>
                                                    <option value="5" {{ (old('search_sede', $searchParams['semestre']) == '5') ? 'selected' : '' }}>5</option>
                                                    <option value="6" {{ (old('search_sede', $searchParams['semestre']) == '6') ? 'selected' : '' }}>6</option>
                                                    <option value="7" {{ (old('search_sede', $searchParams['semestre']) == '7') ? 'selected' : '' }}>7</option>
                                                    <option value="8" {{ (old('search_sede', $searchParams['semestre']) == '8') ? 'selected' : '' }}>8</option>
                                                    <option value="9" {{ (old('search_sede', $searchParams['semestre']) == '9') ? 'selected' : '' }}>9</option>
                                                    <option value="10" {{ (old('search_sede', $searchParams['semestre']) == '10') ? 'selected' : '' }}>10</option> 
                                                    <option value="11" {{ (old('search_sede', $searchParams['semestre']) == '11') ? 'selected' : '' }}>11</option> 
                                                </select>
                                            </th>
                                            <th>
                                                Área
                                                <select type="search" name="search_area" id="search_area" class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Seleccionar Área</option>
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->area }}" {{ (old('search_area', $searchParams['area']) == $area->area) ? 'selected' : '' }}>{{ $area->area }}</option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            
                                            <th>
                                                Categoría
                                                <select type="search" name="search_categoria" id="search_categoria" class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0" >Todos</option>
                                                    <option value="Sugerencia" {{ (old('search_categoria', $searchParams['categoria']) == 'Sugerencia') ? 'selected' : '' }}>Sugerencia</option>
                                                    <option value="Reclamo" {{ (old('search_categoria', $searchParams['categoria']) == 'Reclamo') ? 'selected' : '' }}>Reclamo</option>
                                                </select>
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th>
                                                Participantes
                                                <select type="search" name="search_by" id="search_by" class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Todos</option>
                                                    <option value="Estudiante" {{ (old('search_by', $searchParams['by_']) == 'Estudiante') ? 'selected' : '' }}>Estudiante</option>
                                                    <option value="Docente" {{ (old('search_by', $searchParams['by_']) == 'Docente') ? 'selected' : '' }}>Docente</option>     
                                                </select>
                                            </th>
                                            </th>
                                            <th>
                                                Rango de fecha
                                                <input class="form-control" type="text" name="datefilter" id="datefilter" placeholder="Filtro por fechas"/>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                <button id="searchButton" class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                        </form>
                        
                        <div class="card-body pt-1">
                            <div id="kt_permissions_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                   <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable no-footer" id="kt_permissions_table">
                                      <thead>
                                         <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Sede</th>
                                            <th>categoria</th>
                                            <th>Participante</th>
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
                                                <td>{{ $s->categoria }}</td>
                                                <td>{{ $s->by_ }}</td>
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
                                    {{ $suggestions->appends(request()->query())->links() }}
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/js-cookie"></script>
@endsection

@section('script')


<script type="text/javascript">
    $(function() {
        var savedStartDate = Cookies.get('savedStartDate');
        var savedEndDate = Cookies.get('savedEndDate');
        if (savedStartDate && savedEndDate) {
            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Borrar',
                },
                startDate: moment(savedStartDate, 'DD/MM/YYYY'),
                endDate: moment(savedEndDate, 'DD/MM/YYYY'),
            });
            $('input[name="datefilter"]').val(savedStartDate + ' - ' + savedEndDate);
        } else {
            //var lastWeekStartDate = today.clone().subtract(1, 'year');
            var defaultStartDate = moment('2022-11-08'); // Fecha de la primera sugerencia
            var today = moment();
            var defaultDateRange = defaultStartDate.format('DD/MM/YYYY') + ' - ' + today.format('DD/MM/YYYY');

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Borrar',
                },
                startDate: defaultStartDate,
                endDate: today,
            });
            $('input[name="datefilter"]').val(defaultDateRange);
        }
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            Cookies.set('savedStartDate', picker.startDate.format('DD/MM/YYYY'));
            Cookies.set('savedEndDate', picker.endDate.format('DD/MM/YYYY'));
        });
        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            Cookies.remove('savedStartDate');
            Cookies.remove('savedEndDate');
        });
    });
</script>

<script>
    $("#button_download").click(function (e) {
        e.preventDefault(); 
        var searchSede = $("#search_sede").val();
        var searchSemestre = $("#search_semestre").val();
        var searchArea = $("#search_area").val();
        var dateFilter = $("#datefilter").val();
        var searchBy = $("#search_by").val();
        var searchCategoria = $("#search_categoria").val();
        var url = 'export' +
            '?search_sede=' + searchSede +
            '&search_semestre=' + searchSemestre +
            '&search_by=' + searchBy +
            '&search_categoria=' + searchCategoria +
            '&search_area=' + searchArea +
            '&datefilter=' + dateFilter;
        window.location.href = url;
    });
</script>
@endsection