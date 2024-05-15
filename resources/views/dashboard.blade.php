@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Inicio')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{ url('/dashboard') }}" class="text-white text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Resumen</li>
    </ul>
@endsection
@section('content-main')

    <head>
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>

    <body class="g-sidenav-show  bg-gray-200">
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title" style="color: rgb(255, 24, 24);">
                                    Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h4>
                                <p class="card-category">Cantidad total de registros</p>
                            </div>
                            <h3 class="mb-0" style="text-align: center; font-weight: bold;">{{ $suggestionCount }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title" style="color: rgb(25, 9, 255);">Semanales</h4>
                                <p class="card-category">Registros de la última semana</p>
                            </div>
                            <h3 class="mb-0" style="text-align: center; font-weight: bold;">{{ $sugerenciasUltimaSemana }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title" style="color: rgb(74, 233, 53);">Mensuales</h4>
                                <p class="card-category">Registros del último
                                    mes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </p>
                            </div>
                            <h3 class="mb-0" style="text-align: center; font-weight: bold;">{{ $sugerenciasUltimoMes }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card card-bordered">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Frecuencia de sugerencias</h4>
                                <table class="table gs-7 gy-7 gx-7">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800">
                                            <th>
                                                Sede
                                                <select type="search" name="search_categoria" id="search_sede"
                                                    class="form-select" data-control="select2" data-placeholder="Todas">
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
                                                <select type="search" name="search_by" id="search_semestre"
                                                    class="form-select" data-control="select2" data-placeholder="Todas">
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
                                            {{-- TODO: Hacer que esta columna ocupe el espacio de 2 --}}
                                            <th>
                                                Área
                                                <select type="search" name="search_by" id="search_area" class="form-select"
                                                    data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Todas las Áreas</option>
                                                    {{-- ! Solo areas activas --}}
                                                    @foreach ($areas as $area)
                                                        @if ($area->deleted == 0)
                                                            <option value="{{ $area->id }}">{{ $area->area }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </th>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <th>
                                                Categoría
                                                <select type="search" name="search_categoria" id="search_categoria"
                                                    class="form-select" data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Todos</option>
                                                    <option value="Sugerencia">Sugerencia</option>
                                                    <option value="Reclamo">Reclamo</option>
                                                </select>
                                            </th>
                                            <th>
                                                Participantes
                                                <select type="search" name="search_by" id="search_by" class="form-select"
                                                    data-control="select2" data-placeholder="Todas">
                                                    <option value="0">Todos</option>
                                                    <option value="Estudiante">Estudiante</option>
                                                    <option value="Docente">Docente</option>
                                                </select>
                                            </th>
                                            <th>
                                                <input class="form-control" type="text" name="datefilter"
                                                    id="datefilter" placeholder="Filtro por fechas" />
                                            </th>
                                            <th>
                                                <button id="searchButtonDate" name="searchButtonDate"
                                                    class="btn btn-primary" type="submit">
                                                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="chartFechas" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Sugerencias por Sede</h4>
                                    <p class="card-category">Rendimiento de la última campaña</p>
                                </div>
                                <div id="chartSede" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-sm-6 mb-xl-0 mb-4">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Sugerencias por Área</h4>
                                    <p class="card-category">Rendimiento de la última campaña</p>
                                </div>
                                <div id="chartArea" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Sugerencias por Carrera</h4>
                                    <p class="card-category">Rendimiento de la última campaña</p>
                                </div>
                                <div id="chartCarrera" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Sugerencias por Semestre</h4>
                                    <p class="card-category">Rendimiento de la última campaña</p>
                                </div>
                                <div id="chartSemestre" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
{{-- TODO: Guardar los nuevos valores de busqueda como cookies para mantener los valores al momento de recargar la pagina --}}
@section('script')
    <script>
        $("#searchButtonDate").click(function() {
            var searchBy = $("#search_by").val();
            var searchCategoria = $("#search_categoria").val();
            var dateRange = $('input[name="datefilter"]').val();

            var searchSede = $('#search_sede').val();
            var searchSemestre = $('#search_semestre').val();
            var searchArea = $('#search_area').val();

            //prettier-ignore
            var url = 'dashboard?datefilter=' + dateRange + '&search_by=' + searchBy + '&search_categoria=' +
                searchCategoria + '&search_sede=' + searchSede + '&search_semestre=' + searchSemestre +
                '&search_area=' + searchArea;
            window.location.href = url;
        });
    </script>

    <script>
        function setSelectValuesInCookies() {
            var searchCategoriaValue = $('#search_categoria').val();
            var searchByValue = $('#search_by').val();
            var searchSedeValue = $('#search_sede').val();
            var searchSemestreValue = $('#search_semestre').val();
            var searchAreaValue = $('#search_area').val();


            document.cookie = 'searchCategoria=' + searchCategoriaValue + '; expires=' + new Date(Date.now() + 7 * 24 * 60 *
                60 * 1000).toUTCString();
            document.cookie = 'searchBy=' + searchByValue + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 * 1000)
                .toUTCString();
            document.cookie = 'searchSede=' + searchSedeValue + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 *
                    1000)
                .toUTCString();
            document.cookie = 'searchSemestre=' + searchSemestreValue + '; expires=' + new Date(Date.now() + 7 * 24 * 60 *
                    60 *
                    1000)
                .toUTCString();
            document.cookie = 'searchArea=' + searchAreaValue + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 *
                    1000)
                .toUTCString();
        }

        function getSelectValuesFromCookies() {
            var searchCategoriaCookie = document.cookie.replace(/(?:(?:^|.*;\s*)searchCategoria\s*=\s*([^;]*).*$)|^.*$/,
                "$1");
            var searchByCookie = document.cookie.replace(/(?:(?:^|.*;\s*)searchBy\s*=\s*([^;]*).*$)|^.*$/, "$1");
            var searchSedeCookie = document.cookie.replace(/(?:(?:^|.*;\s*)searchSede\s*=\s*([^;]*).*$)|^.*$/, "$1");;
            var searchSemestreCookie = document.cookie.replace(/(?:(?:^|.*;\s*)searchSemestre\s*=\s*([^;]*).*$)|^.*$/,
                "$1");;
            var searchAreaCookie = document.cookie.replace(/(?:(?:^|.*;\s*)searchArea\s*=\s*([^;]*).*$)|^.*$/, "$1");;


            if (searchCategoriaCookie) {
                $('#search_categoria').val(searchCategoriaCookie).trigger('change');
            }
            if (searchByCookie) {
                $('#search_by').val(searchByCookie).trigger('change');
            }
            if (searchSedeCookie) {
                $('#search_sede').val(searchSedeCookie).trigger('change');
            }
            if (searchSemestreCookie) {
                $('#search_semestre').val(searchSemestreCookie).trigger('change');
            }
            if (searchAreaCookie) {
                $('#search_area').val(searchAreaCookie).trigger('change');
            }
        }
        $(document).ready(function() {
            getSelectValuesFromCookies();
            $("#searchButtonDate").click(function() {
                setSelectValuesInCookies();
                getSelectValuesFromCookies();
            });
        });
    </script>

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
                // ! fecha default
                var today = moment();
                var lastWeekStartDate = today.clone().subtract(1, 'month');
                var defaultDateRange = lastWeekStartDate.format('DD/MM/YYYY') + ' - ' + today.format('DD/MM/YYYY');
                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Borrar',
                    },
                    startDate: lastWeekStartDate,
                    endDate: today,
                });
                $('input[name="datefilter"]').val(defaultDateRange);
            }

            // capturar el evento del boton Apply del selector de fecha y al tiempo que poblamos el input texto con las nueva fechas también las almacenamos en cookies
            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
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

    @if (!empty($sugerenciasPorFecha))
        <script>
            var datos = @json($sugerenciasPorFecha);

            var series = datos.map(function(item) {
                return item.total;
            });

            var categories = datos.map(function(item) {
                return item.fecha;
            });

            var options = {
                series: [{
                    name: 'Sugerencias',
                    data: series,
                }],
                chart: {
                    height: 350,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth',
                },
                xaxis: {
                    type: 'datetime',
                    categories: categories,
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy',
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chartFechas"), options);
            chart.render();
        </script>
    @endif

    @if (!empty($sugerenciasPorSede))
        <script>
            var datos = @json($sugerenciasPorSede);

            var series = datos.map(function(item) {
                return item.total;
            });

            var labels = datos.map(function(item) {
                return item.sede;
            });

            var options = {
                series: series,
                labels: labels,
                chart: {
                    type: 'donut',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chartSede"), options);
            chart.render();
        </script>
    @endif

    <script>
        var areas = [
            @foreach ($sugerenciasPorArea as $area)
                '{{ $area->area }}',
            @endforeach
        ];

        console.log("areas");
        console.log(`{{ $sugerenciasPorArea }}`);

        var data = [
            @foreach ($sugerenciasPorArea as $area)
                {{ $area->total }},
            @endforeach
        ];

        var options = {
            series: [{
                data: data
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: areas
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            yaxis: {
                reversed: true,
                axisTicks: {
                    show: true
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartArea"), options);
        chart.render();
    </script>

    @if (!empty($sugerenciasPorCarrera))
        <script>
            var datosCarrera = @json($sugerenciasPorCarrera);

            var seriesCarrera = datosCarrera.map(function(item) {
                return item.total;
            });

            var labelsCarrera = datosCarrera.map(function(item) {
                return item.carrera;
            });
            if (labelsCarrera.includes(null)) {
                seriesCarrera.push(0);
                labelsCarrera.push('Sin Carrera');
            }

            var optionsCarrera = {
                series: [{
                    name: 'Sugerencias',
                    data: seriesCarrera,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"],
                    },
                },
                xaxis: {
                    categories: labelsCarrera,
                    position: 'top',
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            },
                        },
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                yaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
                title: {
                    text: 'Sugerencias por Carrera',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444',
                    },
                },
            };

            var chartCarrera = new ApexCharts(document.querySelector("#chartCarrera"), optionsCarrera);
            chartCarrera.render();
        </script>
    @endif

    @if (!empty($sugerenciasPorSemestre))
        <script>
            var datos = @json($sugerenciasPorSemestre);

            var series = datos.map(function(item) {
                return item.total;
            });

            var categories = datos.map(function(item) {
                return item.semestre;
            });
            if (categories.includes(null)) {
                series.push(0);
                categories.push('Sin semestre');
            }

            var options = {
                series: [{
                    name: "Sugerencias",
                    data: series,
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        borderRadius: 0,
                        horizontal: true,
                        distributed: true,
                        barHeight: '80%',
                        isFunnel: true,
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return "Semestre " + opt.w.globals.labels[opt.dataPointIndex] + " : " + val;
                    },
                    dropShadow: {
                        enabled: true,
                    },
                },
                title: {
                    text: 'Sugerencias por Semestre',
                    align: 'middle',
                },
                xaxis: {
                    categories: categories,
                },
                legend: {
                    show: false,
                },
            };

            var chart = new ApexCharts(document.querySelector("#chartSemestre"), options);
            chart.render();
        </script>
    @endif

@endsection
