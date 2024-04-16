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
            {{-- <tr class = "deleted-row">
                <td>LPZ</td>
                <td>Sugerencia</td>
                <td>Estudiante</td>
                <td>PSI</td>
                <td>6</td>
                <td>
                    <p class="truncate">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, hic! Itaque
                        earum saepe, cumque possimus atque pariatur cupiditate dicta? Itaque at alias nulla quaerat vero
                        pariatur blanditiis perspiciatis aliquam eos earum ut debitis unde optio odio suscipit quam,
                        temporibus accusantium dolor a sint natus quod aperiam quibusdam. Asperiores, dolorem maxime.
                    </p>
                </td>
                <td>
                    SUBÁREA CAFETERÍA 1
                </td>
                <td>
                    <p class = "truncate">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis alias nulla
                        et, culpa
                        temporibus sit dicta laudantium maxime exercitationem aliquid expedita! Nihil aliquam blanditiis
                        animi at quia doloremque qui nulla, magnam cupiditate quos. Itaque accusantium expedita
                        reprehenderit neque dolorum. Ad laudantium neque quod labore ducimus blanditiis deleniti
                        veritatis excepturi. Vitae consequuntur animi fugit voluptatibus beatae cupiditate, praesentium
                        necessitatibus officia temporibus inventore a eaque repellat exercitationem atque neque
                        reprehenderit quasi minus aspernatur ab quisquam. Amet sed laborum libero cum quaerat cumque
                        explicabo, corporis tempore quos cupiditate minima. Harum provident molestias quae reprehenderit
                        alias facere quis. Possimus doloribus, veritatis earum at perspiciatis eos enim atque dolores
                        asperiores illum repudiandae ipsum quos totam facere ut pariatur quis aut numquam vero culpa
                        alias. Asperiores est vitae ipsum, minus repellendus officiis eligendi itaque expedita eaque
                        deserunt! Quis sed cum illum accusantium facilis quae minus voluptates omnis sint, et delectus
                        atque nihil blanditiis, tempora praesentium dolore nisi hic sequi porro officiis obcaecati
                        debitis iusto. Vel rerum animi excepturi possimus accusamus modi nihil molestiae mollitia
                        tenetur optio? Magnam deserunt assumenda alias voluptates odit voluptate in cum possimus odio
                        facilis quisquam tempora delectus laboriosam doloribus eaque temporibus, hic reprehenderit
                        dolore excepturi. Assumenda, suscipit eum. Cumque repudiandae amet eveniet, facilis, reiciendis
                        excepturi omnis expedita numquam nam quia aperiam? Doloribus quaerat quos quidem sit maiores
                        accusamus perspiciatis similique unde, quas laboriosam voluptas, amet nulla praesentium fugit
                        natus vel porro aperiam voluptatibus inventore odio, earum corporis velit iusto. Asperiores
                        voluptatibus consectetur mollitia nulla maxime unde eveniet impedit repellat dolorem suscipit
                        similique repudiandae et, delectus tempora cupiditate cum fuga rerum sed? Similique accusantium
                        facere perspiciatis dolores obcaecati voluptate minima culpa recusandae animi velit. Consectetur
                        possimus ratione nihil omnis eum? Laboriosam aliquid autem hic, distinctio a possimus,
                        architecto culpa optio iusto repudiandae velit ut, minus commodi quod magnam? Corporis molestiae
                        numquam ipsam recusandae.</p>
                </td>
                <td>2024-04-05 11:14:27</td>
                <td><span class="badge badge-secondary">INACTIVO</span></td>
                <td class="d-flex bd-highlight">
                    <button class="btn btn-light-primary updateRegisterBtn m-1 table-suggestions-btn"><i
                            class="fa-solid fa-arrows-rotate"></i></button>
                </td>
            </tr> --}}
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
                                {{ $s->objeto_area->area }}
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
                            <span class="badge badge-secondary">INACTIVO</span>
                        </td>
                        <td class="d-flex bd-highlight">
                            <button class="btn btn-light-primary updateRegisterBtn m-1"
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
                            @isset($s->objeto_area->area)
                                {{ $s->objeto_area->area }}
                            @else
                                <span class="badge badge-primary">Sin Asignar</span>
                            @endisset
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
                            @if ($s->deleted == 1)
                                <span class="badge badge-danger">INACTIVO</span>
                            @else
                                <span class="badge badge-success">ACTIVO</span>
                            @endif
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
