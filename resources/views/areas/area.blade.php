@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Áreas')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{ url('/area') }}" class="text-white text-hover-primary">Área</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Resumen</li>
    </ul>
@endsection

@section('estilos-css')
    <link rel="stylesheet" href="{{ asset('css/areas.css') }}">
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
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate"><i
                                            class="fa-solid fa-plus"></i>Agregar área</a>
                                    <!--ModalCreate-->
                                    <div class="modal fade" tabindex="-1" id="modalCreate">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Crear área</h3>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ki-duotone ki-cross fs-1"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('areas.store') }}" method="post">
                                                        @csrf
                                                        <div class="mb-10">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Área</label>
                                                            <div class="position-relative">
                                                                <div class="required position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid" name="area"
                                                                    placeholder="Insertar nueva área" required />
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-1">
                                <div id="kt_permissions_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="py-5">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 gy-7"
                                                id = "table-areas">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th></th>
                                                        <th>ÁREA</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($areas as $a)
                                                        @if ($a->deleted == 0)
                                                            <tr id-area = "{{ $a->id }}">
                                                                <td>
                                                                    <a href="#" class = "collapse-subareas"
                                                                        id-area = "{{ $a->id }}"><i
                                                                            class="fa-solid fa-chevron-down rotate"></i></a>
                                                                </td>
                                                                <td><span
                                                                        class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <p class = "tr-txt">{{ $a->area }}</p>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-light-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalUpdate{{ $a->id }}"><i
                                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                                    <button class="btn btn-light-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalDelete{{ $a->id }}"><i
                                                                            class="fa-solid fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr id-area = "{{ $a->id }}" class = "deleted-row">
                                                                <td></td>
                                                                <td><span
                                                                        class="badge badge-secondary">INACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <p class = "tr-txt">{{ $a->area }}</p>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-light-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalRestore{{ $a->id }}"><i
                                                                            class="fa-solid fa-arrows-rotate"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif


                                                        <!--ModalUpdate-->
                                                        <div class="modal fade" tabindex="-1"
                                                            id="modalUpdate{{ $a->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h3 class="modal-title">Modificar área</h3>

                                                                        <!--begin::Close-->
                                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span></i>
                                                                        </div>
                                                                        <!--end::Close-->
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="{{ route('areas.update', $a->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-10">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">ID</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-solid"
                                                                                        placeholder="{{ $a->id }}"
                                                                                        readonly />
                                                                                </div>
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">Área</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-solid"
                                                                                        name="area"
                                                                                        value="{{ $a->area }}" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-light"
                                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Actualizar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--ModalDelete-->
                                                        <div class="modal fade" tabindex="-1"
                                                            id="modalDelete{{ $a->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h3 class="modal-title">Eliminar área</h3>

                                                                        <!--begin::Close-->
                                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span></i>
                                                                        </div>
                                                                        <!--end::Close-->
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('areas.destroy', $a->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="mb-10">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">Estás seguro de
                                                                                    eliminar
                                                                                    <strong>{{ $a->area }}</strong></label>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-light"
                                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Eliminar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- MODAL REESTABLECER --}}
                                                        <div class="modal fade" tabindex="-1"
                                                            id="modalRestore{{ $a->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h3 class="modal-title">Reestablecer área</h3>

                                                                        <!--begin::Close-->
                                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span></i>
                                                                        </div>
                                                                        <!--end::Close-->
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="{{ route('areas.undo-delete') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('POST')
                                                                            <input type="hidden"
                                                                                value = "{{ $a->id }}"
                                                                                name = "areaId">
                                                                            <div class="mb-10">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">Estás seguro de
                                                                                    reestablecer
                                                                                    <strong>{{ $a->area }}</strong></label>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-light"
                                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Reestablecer</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    {{-- ! MODAL UPDATE SUBAREA --}}
                                    <div class="modal fade" tabindex="-1" id="modalUpdateSubarea">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Modificar Subárea</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form id = "update_subarea_form">
                                                        <div class="mb-10">
                                                            <label for="exampleFormControlInput1" class="form-label">Área
                                                                a la que pertence:</label>
                                                            <div class="position-relative mb-3">
                                                                <input type="text"
                                                                    class="form-control form-control-solid update-subarea-txt"
                                                                    readonly disabled />
                                                            </div>
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Editar
                                                                Subárea:</label>
                                                            <div class="position-relative">
                                                                <div class="required position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid update-subarea-txt"
                                                                    name="area" autocomplete="off" required />
                                                            </div>
                                                            <input type="hidden" class = "update-subarea-txt">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button class="btn btn-primary"
                                                                type = "submit">Actualizar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ! MODAL CONFIRMAR EDICIÓN SUBÁREA --}}
                                    <div class="modal fade" id="modalUpdateSubarea2" aria-hidden="true"
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
                                                    <button id="updateSubareaBtn" class="btn btn-primary">SÍ</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ! MODAL CONFIRMAR ELIMINACIÓN SUBÁREA --}}
                                    <div class="modal fade" id="modalDeleteSubarea" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">CONFIRMACIÓN
                                                    </h5>
                                                </div>
                                                <div class="modal-body fs-5">
                                                    ¿Estás seguro de eliminar el registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="deleteSubareaBtn" class="btn btn-primary">SÍ</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ! MODAL CONFIRMAR RESTAURACIÓN SUBÁREA --}}
                                    <div class="modal fade" id="modalRestoreSubarea" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">CONFIRMACIÓN
                                                    </h5>
                                                </div>
                                                <div class="modal-body fs-5">
                                                    ¿Estás seguro de reestablecer este registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="restoreSubareaBtn" class="btn btn-primary">SÍ</button>
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ! MODAL CREAR NUEVA SUBÁREA --}}
                                    <div class="modal fade" tabindex="-1" id="modalCreateSubarea">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Nueva Subárea</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form id = "create_subarea_form">
                                                        <div class="mb-10">
                                                            <label for="exampleFormControlInput1" class="form-label">Área
                                                                a la que pertence:</label>
                                                            <div class="position-relative mb-3">
                                                                <input type="text"
                                                                    class="form-control form-control-solid create-subarea-txt"
                                                                    value = "Fundación UNIFRANZ" readonly disabled />
                                                            </div>
                                                            <label for="exampleFormControlInput1" class="form-label">Nueva
                                                                Subárea:</label>
                                                            <div class="position-relative">
                                                                <div class="required position-absolute top-0"></div>
                                                                <input type="text"
                                                                    class="form-control form-control-solid create-subarea-txt"
                                                                    name="area" autocomplete="off" required />
                                                            </div>
                                                            <input type="hidden" class = "create-subarea-txt">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ! NOTIFICACIONES TOAST --}}
                                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:99999;">
                                        <div class="toast align-items-center text-white bg-primary border-0 p-3 fs-5"
                                            id = "updateSubareaToast" role="alert" aria-live="assertive"
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
                                            id = "createSubareaToast" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Creado exitosamente.
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="toast-container position-static position-fixed bottom-0 end-0 p-3"
                                        style="z-index:99999;">
                                        <div class="toast align-items-center text-white bg-primary border-0 p-3 fs-6"
                                            id = "deleteSubareaToast1" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Descartado correctamente.
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <div class="toast align-items-center text-white bg-primary border-0 p-3 fs-6"
                                            id = "deleteSubareaToast2" role="alert" aria-live="assertive"
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

                                    {{-- ! PRESCINDIR de la paginacion --}}
                                    {{-- <div class="mt-5">
                                        {{ $areas->links() }}
                                    </div> --}}
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
    <script src="{{ asset('js/areas.js') }}"></script>
@endsection
