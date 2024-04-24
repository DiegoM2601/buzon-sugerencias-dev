@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Sugerencias')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{ url('/') }}" class="text-white text-hover-primary">Sugerencias</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Resumen</li>
    </ul>
@endsection

@section('estilos-css')
    <link rel="stylesheet" href="{{ asset('css/sugerencias.css') }}">
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
                                    <button href="{{ url('export') }}" type="button" class="btn btn-sm btn-success"
                                        id="button_download" name="button_download">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z"
                                                    fill="currentColor"></path>
                                                <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.3"
                                                    d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->Download Report</button>
                                </div>
                            </div>

                            <form href="" method="get" id = "searchForm">
                                @csrf
                                <div class="table-responsive" id = "table-params">
                                    <table class="table gs-7 gy-7 gx-7">
                                        <thead>
                                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                <th>
                                                    Sede
                                                    <select type="search" name="search_sede" id="search_sede"
                                                        class="form-select selectSearchParam" data-placeholder="Todas">
                                                        <option value="0">Todos</option>
                                                        <option value="LPZ">
                                                            La Paz</option>
                                                        <option value="SCZ">
                                                            Santa Cruz</option>
                                                        <option value="CBB">
                                                            Cochabamba</option>
                                                        <option value="EAT">
                                                            El Alto</option>
                                                    </select>
                                                </th>
                                                <th>
                                                    Semestre
                                                    <select type="search" name="search_semestre" id="search_semestre"
                                                        class="form-select selectSearchParam" data-placeholder="Todas">
                                                        <option value="0">Todos</option>
                                                        <option value="1">
                                                            1</option>
                                                        <option value="2">
                                                            2</option>
                                                        <option value="3">
                                                            3</option>
                                                        <option value="4">
                                                            4</option>
                                                        <option value="5">
                                                            5</option>
                                                        <option value="6">
                                                            6</option>
                                                        <option value="7">
                                                            7</option>
                                                        <option value="8">
                                                            8</option>
                                                        <option value="9">
                                                            9</option>
                                                        <option value="10">
                                                            10</option>
                                                        <option value="11">
                                                            11</option>
                                                    </select>
                                                </th>
                                                <th>
                                                    Área
                                                    <select type="search" name="search_area" id="search_area"
                                                        class="form-select selectSearchParam" data-placeholder="Todas">
                                                        <option value="0">Todas las Áreas</option>
                                                        {{-- ! Incluir en la busqueda areas que hayan sido eliminadas lógicamente --}}
                                                        @foreach ($areas as $area)
                                                            @if ($area->deleted == 0)
                                                                <option value="{{ $area->id }}">{{ $area->area }}
                                                                </option>
                                                            @else
                                                                <option class = "text-danger" value="{{ $area->id }}">
                                                                    {{ $area->area }} (Área Deprecada)
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </th>

                                                <th>
                                                    Categoría
                                                    <select type="search" name="search_categoria" id="search_categoria"
                                                        class="form-select selectSearchParam" data-placeholder="Todas">
                                                        <option value="0">Todos</option>
                                                        <option value="Sugerencia">
                                                            Sugerencia</option>
                                                        <option value="Reclamo">
                                                            Reclamo</option>
                                                    </select>
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>
                                                    Participantes
                                                    <select type="search" name="search_by" id="search_by"
                                                        class="form-select selectSearchParam">
                                                        <option value="0">Todos</option>
                                                        <option value="Estudiante">
                                                            Estudiante</option>
                                                        <option value="Docente">
                                                            Docente</option>
                                                    </select>
                                                </th>
                                                </th>
                                                <th>
                                                    Rango de fecha
                                                    <input class="form-control selectSearchParam" type="text"
                                                        name="datefilter" id="datefilter" placeholder="Filtro por fechas"
                                                        autocomplete="off" />
                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                    {{-- <button id="searchButton" class="btn btn-primary" type="submit"><i
                                                            class="fa-solid fa-magnifying-glass"></i> Buscar</button> --}}

                                                    {{-- <button id="buscarBtn" class="btn btn-light-primary"><i
                                                            class="fa-solid fa-magnifying-glass"></i>Buscar</button> --}}
                                                </th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </form>

                            <div class="card-body pt-1">
                                <div id="kt_permissions_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    @include('table-home')
                                    {{-- Modal Actualizar --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalUpdateSuggestion" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualizar
                                                        Registro
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style = "display: flex; justify-content: center">
                                                    <input type="hidden" id = "pruebaVariable">
                                                    <div style = "width: 100%; padding: 1em;">
                                                        <div class="mb-3">
                                                            <label>Sede</label>
                                                            <select disabled class="form-select">
                                                                <option value="LPZ">
                                                                    La Paz</option>
                                                                <option value="SCZ">
                                                                    Santa Cruz</option>
                                                                <option value="CBB">
                                                                    Cochabamba</option>
                                                                <option value="EAT">
                                                                    El Alto</option>
                                                            </select>

                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Categoría</label>
                                                            <select class="form-select">
                                                                <option value="Sugerencia">
                                                                    Sugerencia</option>
                                                                <option value="Reclamo">
                                                                    Reclamo</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Participante</label>
                                                            <select disabled class="form-select">
                                                                <option value="Estudiante">
                                                                    Estudiante</option>
                                                                <option value="Docente">
                                                                    Docente</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Carrera</label>
                                                            <select disabled class="form-select">
                                                                <option value = "ADM">ADM</option>
                                                                <option value = "AHT">AHT</option>
                                                                <option value = "ARQ">ARQ</option>
                                                                <option value = "BYF">BYF</option>
                                                                <option value = "CPU">CPU</option>
                                                                <option value = "DER">DER</option>
                                                                <option value = "DGP">DGP</option>
                                                                <option value = "ENF">ENF</option>
                                                                <option value = "ICO">ICO</option>
                                                                <option value = "IEC">IEC</option>
                                                                <option value = "IEF">IEF</option>
                                                                <option value = "MED">MED</option>
                                                                <option value = "ODO">ODO</option>
                                                                <option value = "PER">PER</option>
                                                                <option value = "PSI">PSI</option>
                                                                <option value = "PYM">PYM</option>
                                                                <option value = "SIS">SIS</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Semestre</label>
                                                            <select disabled class="form-select">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Área</label>
                                                            <select class="form-select"
                                                                id = "modalUpdateSelectArea"></select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Subárea</label>
                                                            <select class="form-select"></select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <div id = "alerta-updateSuggestion" role="alert">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style = "width: 100%; padding: 1em;">
                                                        <div class="mb-3">
                                                            <label for="suggestionTextarea" class="form-label">Fecha
                                                                de Publicación</label>
                                                            <div class="input-group" id="datepicker1"
                                                                data-td-target-input="nearest"
                                                                data-td-target-toggle="nearest">
                                                                <input disabled style = "background: #EFF2F5"
                                                                    id="kt_td_picker_basic_input" type="text"
                                                                    class="form-control"
                                                                    data-td-target="#kt_td_picker_basic" readonly />
                                                                <span class="input-group-text"
                                                                    data-td-target="#kt_td_picker_basic"
                                                                    data-td-toggle="datetimepicker">
                                                                    <i class="fas fa-calendar-week fs-2"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3"
                                                            sytle = " width: 100%;
                                                            height: 100%; ">
                                                            <label for="suggestionTextarea"
                                                                class="form-label">Comentario</label>
                                                            <textarea class="form-control" rows="10" id="suggestionTextarea" disabled></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="button" class="btn btn-secondary"
                                                                id = "restoreSuggestionBtn"><i
                                                                    class="fa-solid fa-arrows-rotate"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">REESTABLECER</button> --}}
                                                    <button type="button" class="btn btn-primary"
                                                        id = "updateSuggestionBtn">ACTUALIZAR</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id = "undoDeleteBtn">REESTABLECER &nbsp;&nbsp;&nbsp;<i
                                                            class="fas fa-undo fs-4"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalUpdateSuggestion2" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">CONFIRMACIÓN
                                                    </h5>
                                                </div>
                                                <div class="modal-body fs-5">
                                                    ¿Estás seguro de modificar el registro?
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button class="btn btn-danger"id="confirmUpdate">SÍ
                                                    </button>
                                                    <button class="btn btn-primary" id="dismissUpdate">NO</button> --}}
                                                    <button id="confirmUpdate" class="btn btn-primary">SÍ</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="position-fixed bottom-0 end-0 p-3">
                                            <div id="updateSuggestionToast"
                                                class="toast hide align-items-center text-white bg-primary border-0"
                                                role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        Registro actualizado correctamente.
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div> --}}

                                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:99999;">
                                        <div class="toast align-items-center text-white bg-primary border-0 p-3 fs-5"
                                            id = "updateSuggestionToast" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Actualizado correctamente.
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:99999;">
                                        <div class="toast align-items-center text-white bg-success border-0 p-3 fs-5"
                                            id = "deleteSuggestionToast" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    El registro fue descartado.
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:99999;">
                                        <div class="toast align-items-center text-white bg-success border-0 p-3 fs-5"
                                            id = "searchParamsToast" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Búsqueda exitosa.
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Modal Eliminar --}}
                                    <div class="modal fade" id="modalDeleteSuggestion" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">CONFIRMACIÓN
                                                    </h5>
                                                </div>
                                                <div class="modal-body fs-5">
                                                    ¿Estás seguro de descartar este registro?
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button class="btn btn-danger"id="confirmDeletion">SÍ
                                                    </button>
                                                    <button class="btn btn-primary" id="dismissDeletion">NO</button> --}}

                                                    <button id="confirmDeletion" class="btn btn-primary">SÍ</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                </div>
                                            </div>
                                        </div>
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
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
                Cookies.set('savedStartDate', picker.startDate.format('DD/MM/YYYY'));
                Cookies.set('savedEndDate', picker.endDate.format('DD/MM/YYYY'));

                // Crear un nuevo evento de tipo 'change'
                var eventoChange = new Event('change');

                // provocar el evento 'change' en el input
                document.querySelector("#datefilter").dispatchEvent(eventoChange);

            });
            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                Cookies.remove('savedStartDate');
                Cookies.remove('savedEndDate');

                // Crear un nuevo evento de tipo 'change'
                var eventoChange = new Event('change');

                // provocar el evento 'change' en el input
                document.querySelector("#datefilter").dispatchEvent(eventoChange);
            });


            // date picker
            // new tempusDominus.TempusDominus(document.getElementById("datepicker1"), {
            //     display: {
            //         viewMode: "calendar",
            //         components: {
            //             decades: true,
            //             year: true,
            //             month: true,
            //             date: true,
            //             hours: false,
            //             minutes: false,
            //             seconds: false
            //         }
            //     }
            // });

            // ! Datepicker 
            new tempusDominus.TempusDominus(document.getElementById("datepicker1"), {
                // defaultDate: "01/11/2013 18:14",
                defaultDate: "2023-02-23 09:53:52",
                localization: {
                    locale: 'es',
                    // format: 'dd/MM/yyyy',
                    // format: 'dd/MM/yyyy HH:mm:ss'
                    format: 'yyyy-MM-dd HH:mm:ss'
                },
                display: {
                    viewMode: "calendar",
                    components: {
                        decades: true,
                        year: true,
                        month: true,
                        date: true,
                        hours: true,
                        minutes: true,
                        seconds: true
                    },
                    theme: 'light'
                }
            });
        });
    </script>

    <script>
        $("#button_download").click(function(e) {
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

    {{-- ! LLEVAR TODOS LOS DROPDOWN A SU ESTADO INICIAL DESPUÉS DE RECARGAR LA PÁGINA --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectores = Array.from(document.querySelectorAll(".selectSearchParam"));

            // excluir input fecha
            selectores.pop();

            selectores.forEach((e) => {
                e.querySelector(
                    `option[value="0"]`
                ).selected = true;
            });
        });
    </script>

    <script src="{{ asset('js/modalUpdateSuggestion.js') }}"></script>
    <script src="{{ asset('js/dynamicSearch.js') }}"></script>
@endsection
