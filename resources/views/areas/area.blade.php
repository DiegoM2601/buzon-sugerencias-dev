@extends('template.app')
@section('show-1', 'show')
@section('title-content', 'Áreas')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
	<li class="breadcrumb-item text-white opacity-75">
		<a href="{{url('/area')}}" class="text-white text-hover-primary">Área</a>
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
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate" ><i class="fa-solid fa-plus"></i>Agregar área</a>
                                <!--ModalCreate-->
                                <div class="modal fade" tabindex="-1" id="modalCreate">
                                        
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Crear área</h3>
                                
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            
                                            <div class="modal-body">
                                                <form action="{{route('areas.store')}}" method="post">
                                                    @csrf
                                                    <div class="mb-10">
                                                        <label for="exampleFormControlInput1" class="form-label">Área</label>
                                                        <div class="position-relative">
                                                            <div class="required position-absolute top-0"></div>
                                                            <input type="text" class="form-control form-control-solid" name="area" placeholder="Insertar nueva área" required/>
                                                        </div>
                                                    </div>
                                                                                                                                                                                                      
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
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
                                <div class="table-responsive">
                                   <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable no-footer" id="kt_permissions_table">
                                      <thead>
                                         <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>ID</th>
                                            <th>Área</th>
                                            <th>Acción</th>

                                         </tr>
                                      </thead>
                                      <tbody class="fw-semibold text-gray-600">
                                        
                                        @foreach ($areas as $a)
                                            <tr>
                                                <td>{{$a->id}}</td>
                                                <td>{{$a->area}}</td>
                                                <td>
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$a->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$a->id}}"><i class="fa-solid fa-trash"></i></button>
                                                    
                                                </td>
                                            </tr>

                                            <!--ModalUpdate-->
                                            <div class="modal fade" tabindex="-1" id="modalUpdate{{ $a->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Modificar área</h3>
                                            
                                                            <!--begin::Close-->
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>
                                            
                                                        <div class="modal-body">
                                                            <form action="{{route('areas.update',$a->id)}}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-10">
                                                                    <label for="exampleFormControlInput1" class="form-label">ID</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control form-control-solid" placeholder="{{ $a->id}}" readonly/>
                                                                    </div>
                                                                    <label for="exampleFormControlInput1" class="form-label">Área</label>
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control form-control-solid" name="area" value="{{ $a->area}}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                </div>
                                                            </form>                  
                                                        </div>                                                           
                                                    </div>
                                                </div>
                                            </div> 
                                            
                                            <!--ModalDelete-->
                                            <div class="modal fade" tabindex="-1" id="modalDelete{{ $a->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Eliminar área</h3>
                                            
                                                            <!--begin::Close-->
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>
                                            
                                                        <div class="modal-body">
                                                            <form action="{{route('areas.destroy',$a->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="mb-10">
                                                                    <label for="exampleFormControlInput1" class="form-label">Estás seguro de eliminar <strong>{{$a->area}}</strong></label>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Eliminar</button>
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
                                <div class="mt-5">
                                {{ $areas->links() }}
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

@section('scripts')

@endsection