<div class="table-responsive" id = "table-suggestions">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable no-footer" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                <th>Sede</th>
                <th>categoria</th>
                <th>Participante</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Área</th>
                <th>Subárea</th>
                <th>Sugerencia</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @foreach ($suggestions as $s)
                @if ($s->deleted == 1)
                    <tr class = "deleted-row">
                        <td>{{ $s->sede }}</td>
                        <td>{{ $s->categoria }}</td>
                        <td>{{ $s->by_ }}</td>
                        <td>{{ $s->carrera }}</td>
                        <td>{{ $s->semestre }}</td>
                        <td>
                            <p class="truncate">
                                {{ $s->area->area }}
                            </p>
                        </td>
                        <td>
                            @isset($s->subarea_id)
                                <p class="truncate">
                                    {{ $s->subarea->subarea }}
                                </p>
                            @else
                                <span class="badge badge-primary">Sin Asignar</span>
                            @endisset
                        </td>
                        <td>
                            <p class = "truncate">{{ $s->sugerencia }}</p>
                        </td>
                        <td>{{ $s->created_at }}</td>
                        <td>
                            <span class="badge badge-secondary">DESCARTADO</span>
                        </td>
                        <td class="d-flex bd-highlight">
                            <button class="btn btn-light-primary restoreRegisterBtn m-1"
                                id-suggestion = "{{ $s->id }}"><i class="fa-solid fa-arrows-rotate"></i></button>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $s->sede }}</td>
                        <td>{{ $s->categoria }}</td>
                        <td>{{ $s->by_ }}</td>
                        <td>{{ $s->carrera }}</td>
                        <td>{{ $s->semestre }}</td>
                        <td>
                            <p class="truncate">
                                {{ $s->area->area }}
                            </p>
                        </td>
                        <td>
                            @isset($s->subarea_id)
                                {{ $s->subarea->subarea }}
                            @else
                                <span class="badge badge-primary">Sin Asignar</span>
                            @endisset
                        </td>
                        <td>
                            <p class = "truncate">{{ $s->sugerencia }}</p>
                        </td>
                        <td>{{ $s->created_at }}</td>
                        <td>
                            <span class="badge badge-success">ACTIVO</span>
                        </td>
                        <td class="d-flex bd-highlight">
                            <button class="btn btn-light-primary updateRegisterBtn m-1"
                                id-suggestion = "{{ $s->id }}"><i
                                    class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-light-primary deleteRegisterBtn m-1"
                                id-suggestion = "{{ $s->id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        {{ $suggestions->appends(request()->query())->links() }}
    </div>
</div>
