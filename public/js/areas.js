const ancla = document.getElementById("ancla");
const _token = document.querySelector("input[name=_token]").value;
const updateSubareaToast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("updateSubareaToast")
);
const deleteSubareaToast1 = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("deleteSubareaToast1")
);
const deleteSubareaToast2 = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("deleteSubareaToast2")
);
let btnPulsado;

// formulario modal update subarea
const updateSubareaForm = document.querySelectorAll(".update-subarea-txt");
const updateSubareaBtn = document.getElementById("updateSubareaBtn");

// formulario modal create subarea
const createSubareaForm = document.querySelectorAll(".create-subarea-txt");
const createSubareaBtn = document.getElementById("createSubareaBtn");

// modal delete subarea
const deleteSubareaBtn = document.getElementById("deleteSubareaBtn");

document.getElementById("table-areas").addEventListener("click", (e) => {
    // ! DESPLEGAR SUBAREAS
    if (
        e.target.classList.contains("collapse-subareas") ||
        e.target.parentNode.classList.contains("collapse-subareas")
    ) {
        e.preventDefault();

        let subareaAnchor = e.target.classList.contains("collapse-subareas")
            ? e.target
            : e.target.parentNode;

        if (
            subareaAnchor.parentNode.parentNode.classList.contains(
                "nested-table-parent"
            )
        ) {
            collapseAll();
        } else {
            collapseAll();
            subareaAnchor.parentNode.parentNode.classList.add(
                "nested-table-parent"
            );
            fetchSubareas(subareaAnchor);
        }
    }
    // ! BOTON ACTUALIZAR SUBAREA
    else if (
        e.target.classList.contains("updateSubarea") ||
        e.target.parentNode.classList.contains("updateSubarea")
    ) {
        prepararModalUpdateSubarea(
            e.target.classList.contains("updateSubarea")
                ? e.target
                : e.target.parentNode
        );
    } else if (
        e.target.classList.contains("createSubarea") ||
        e.target.parentNode.classList.contains("createSubarea")
    ) {
        prepararModalCreateSubarea(
            e.target.classList.contains("createSubarea")
                ? e.target
                : e.target.parentNode
        );
    } else if (
        e.target.classList.contains("deleteSubarea") ||
        e.target.parentNode.classList.contains("deleteSubarea")
    ) {
        btnPulsado = e.target.classList.contains("deleteSubarea")
            ? e.target
            : e.target.parentNode;
        $("#modalDeleteSubarea").modal("show");
    }
});

const prepararModalUpdateSubarea = (btn) => {
    // updateSubareaForm[0].value =
    //     btn.parentNode.parentNode.querySelector("td").innerText;

    btnPulsado = btn;

    updateSubareaForm[0].value = document
        .querySelector(".nested-table-parent")
        .querySelectorAll("td")[1].innerText;
    updateSubareaForm[1].value =
        btn.parentNode.parentNode.querySelector("td").innerText;

    updateSubareaForm[2].value = btn.getAttribute("id-subarea");

    $("#modalUpdateSubarea").modal("show");

    console.log("btn:" + btn.getAttribute("id-subarea"));
};
updateSubareaBtn.addEventListener("click", (e) => {
    e.preventDefault();
    $("#modalUpdateSubarea2").modal("hide");
    let updatedRow = btnPulsado.parentNode.parentNode;

    // TODO: Actualizar la URL
    //prettier-ignore
    // * animacion
    updatedRow.innerHTML = `
        <td colspan="3">
            <img src="https://buzon-sugerencias.bo/gifs/loading2.gif" width = "120px">
        </td>
    `;
    updatedRow.classList.toggle("center-text");

    axios
        .post("https://buzon-sugerencias.bo/update-subarea", {
            headers: {
                "X-CSRF-TOKEN": _token,
            },
            idSubarea: updateSubareaForm[2].value,
            subarea: updateSubareaForm[1].value,
        })
        .then((res) => {
            console.log(res.data);
            updatedRow.innerHTML = `
                <td>${res.data.subarea}</td>
                <td>
                    <button class="btn btn-light-primary updateSubarea" id-subarea = "${res.data.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-light-primary deleteSubarea" id-subarea = "${res.data.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            updatedRow.classList.toggle("center-text");
            updateSubareaToast.show();
        })
        .catch((err) => {
            console.error("Error al realizar la solicitud:", err);
        });
});

createSubareaBtn.addEventListener("click", async () => {
    let newRow = document.createElement("tr");
    let subarea = createSubareaForm[1].value;
    let areaId = createSubareaForm[2].value;

    // console.log(subarea, areaId);

    let nuevaSubareaId = await createSubarea(areaId, subarea);

    if (btnPulsado.classList.contains("empty-nested-table")) {
        // console.log(btn.parentNode.parentNode);

        //prettier-ignore
        btnPulsado.parentNode.parentNode.innerHTML = `
            <td class = "nested-add-subarea">
                <button class="btn btn-light-primary createSubarea">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </td>
            <td colspan="2">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border gy-7 gs-7 table-subareas-nested">
                        <tbody>
                            <tr class = "formato-tabla" id-subarea = "${nuevaSubareaId}">
                                <td>${subarea}</td>
                                <td>
                                    <button class="btn btn-light-primary updateSubarea" id-subarea = "${nuevaSubareaId}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-light-primary deleteSubarea" id-subarea = "${nuevaSubareaId}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>   
        `;
    } else {
        //TODO: Insertar el id de la subarea en lugar de la area
        //prettier-ignore
        newRow.innerHTML = `
            <td>${subarea}</td>
            <td>
                <button class="btn btn-light-primary updateSubarea" id-subarea = "${nuevaSubareaId}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-light-primary deleteSubarea" id-subarea = "${nuevaSubareaId}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;

        insertAfter(
            document.querySelector(".table-subareas-nested tr:last-child"),
            newRow
        );
    }
    $("#modalCreateSubarea").modal("hide");
});

deleteSubareaBtn.addEventListener("click", async () => {
    let row = btnPulsado.parentNode.parentNode;
    let nestedTable = document.querySelector(".table-subareas-nested");

    //TODO: Notificar al usuario cuantos registros de la tabla sugerencias se han modificado
    let res = await deleteSubarea(row.getAttribute("id-subarea"));
    console.log(res.onDeleteSuggestions);

    deleteSubareaToast1.show();

    document.querySelector(
        "#deleteSubareaToast2 .toast-body"
    ).innerHTML = `Se han actualizado ${res.onDeleteSuggestions} registros adicionalmente.`;
    deleteSubareaToast2.show();

    row.remove();

    // * si la nested table se halla vacia ...
    if (nestedTable && nestedTable.querySelectorAll("tr").length === 0) {
        document.querySelector(".nested-table").remove();

        // return;

        let newRow = document.createElement("tr");
        newRow.classList.add("nested-table");

        //prettier-ignore
        newRow.innerHTML = `
            <td class = "nested-add-subarea">
                <button class="btn btn-light-primary createSubarea empty-nested-table">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </td>
            <td colspan="2" style="text-align: center;">
                <div class="alert alert-secondary" role="alert">
                    Esta área aún no cuenta con subáreas asignadas.
                </div>
            </td>
        `;

        insertAfter(document.querySelector(".nested-table-parent"), newRow);

        window.getComputedStyle(newRow).opacity;
        newRow.className += " nested-table-show";
    }

    $("#modalDeleteSubarea").modal("hide");
});

const prepararModalCreateSubarea = (btn) => {
    btnPulsado = btn;
    createSubareaForm[0].value = document
        .querySelector(".nested-table-parent")
        .querySelectorAll("td")[1].innerText;

    createSubareaForm[2].value = document
        .querySelector(".nested-table-parent")
        .getAttribute("id-area");

    $("#modalCreateSubarea").modal("show");
};

// ! COLAPSAR TODAS LAS TABLAS ANIDADAS
const collapseAll = () => {
    var nestedTableRows = document
        .getElementById("table-areas")
        .querySelectorAll("tr.nested-table");

    var nestedTableParents = document
        .getElementById("table-areas")
        .querySelectorAll("tr.nested-table-parent");

    if (nestedTableRows.length > 0) {
        // * Elminar todas las tablas anidadas del DOM
        nestedTableRows.forEach((e) => {
            e.remove();
        });

        // * Llevar todos los iconos a su estado inicial
        let iconos = document
            .getElementById("table-areas")
            .querySelectorAll("tr .collapse-subareas i");
        iconos.forEach((e) => {
            e.classList.remove("rotate-180");
        });

        if (nestedTableParents.length > 0) {
            nestedTableParents.forEach((e) => {
                e.classList.remove("nested-table-parent");
            });
        }
    }
};

const fetchSubareas = async (a) => {
    //rotar icono
    a.querySelector("i").classList.toggle("rotate-180");
    console.log(a.parentNode.parentNode);

    let subareas = await consultarSubareas(a.getAttribute("id-area"));

    if (subareas && subareas.length > 0) {
        let subareasRows = subareas
            .map((obj) => {
                //prettier-ignore
                return `
                <tr class = "formato-tabla" id-subarea = "${obj.id}">
                    <td>${obj.subarea}</td>
                    <td>
                        <button class="btn btn-light-primary updateSubarea" id-subarea = "${obj.id}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-light-primary deleteSubarea" id-subarea = "${obj.id}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>`;
            })
            .join("");

        let newRow = document.createElement("tr");
        newRow.classList.add("nested-table");

        //prettier-ignore
        newRow.innerHTML = `
            <td class = "nested-add-subarea">
                <button class="btn btn-light-primary createSubarea">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </td>
            <td colspan="2">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border gy-7 gs-7 table-subareas-nested">
                        <tbody>
                            ${subareasRows}
                        </tbody>
                    </table>
                </div>
            </td>   
        `;

        insertAfter(a.parentNode.parentNode, newRow);

        //animacion
        window.getComputedStyle(newRow).opacity;
        newRow.className += " nested-table-show";
    } else {
        //TODO: llevar el siguiente código a una función, el mismo se ejecuta también al momento de eliminar filas cuando la nested-table queda vacía
        let newRow = document.createElement("tr");
        newRow.classList.add("nested-table");

        //FIXME: Esta línea sirve?
        newRow.innerHTML = `
        <div class="alert alert-secondary" role="alert">
            Esta área aún no cuenta con subáreas asignadas.
        </div>
        `;

        //prettier-ignore
        newRow.innerHTML = `
            <td class = "nested-add-subarea">
                <button class="btn btn-light-primary createSubarea empty-nested-table">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </td>
            <td colspan="2" style="text-align: center;">
                <div class="alert alert-secondary" role="alert">
                    Esta área aún no cuenta con subáreas asignadas.
                </div>
            </td>  
        `;

        insertAfter(a.parentNode.parentNode, newRow);

        //animacion
        window.getComputedStyle(newRow).opacity;
        newRow.className += " nested-table-show";
    }

    // newRow.innerHTML = `<td>ejemplo</td><td>ejemplo</td><td>ejemplo</td>`;
    // insertAfter(a.parentNode.parentNode, newRow);
};

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

const consultarSubareas = (idArea) => {
    return new Promise((resolve, reject) => {
        axios
            .get("https://buzon-sugerencias.bo/get-subareas/" + idArea, {
                headers: {
                    "X-CSRF-TOKEN": _token,
                },
            })
            .then(function (response) {
                resolve(response.data);
            })
            .catch(function (error) {
                reject(error);
            });
    });
};

const createSubarea = (areaId, subarea) => {
    return new Promise((resolve, reject) => {
        axios
            .post("https://buzon-sugerencias.bo/create-subarea", {
                headers: {
                    "X-CSRF-TOKEN": _token,
                },
                areaId,
                subarea,
            })
            .then((res) => {
                resolve(res.data.subareaId);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

const deleteSubarea = (subareaId) => {
    return new Promise((resolve, reject) => {
        axios
            .post("https://buzon-sugerencias.bo/delete-subarea", {
                headers: {
                    "X-CSRF-TOKEN": _token,
                },
                subareaId,
            })
            .then((res) => {
                resolve(res.data);
            })
            .catch((err) => {
                reject(err);
            });
    });
};
