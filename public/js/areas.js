const _token = document.querySelector("input[name=_token]").value;
let btnPulsado;

const updateSubareaToast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("updateSubareaToast")
);
const deleteSubareaToast1 = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("deleteSubareaToast1")
);
const deleteSubareaToast2 = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("deleteSubareaToast2")
);
const createSubareaToast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("createSubareaToast")
);

// formulario modal update subarea
const updateSubareaFormInput = document.querySelectorAll(".update-subarea-txt");
const updateSubareaForm = document.getElementById("update_subarea_form");
const updateSubareaBtn = document.getElementById("updateSubareaBtn");

// formulario modal create subarea
const createSubareaFormInput = document.querySelectorAll(".create-subarea-txt");
const createSubareaForm = document.getElementById("create_subarea_form");

// modal delete subarea
const deleteSubareaBtn = document.getElementById("deleteSubareaBtn");

// ! EVENTOS NESTED TABLE
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
    }
    // ! BOTON CREAR SUBAREA
    else if (
        e.target.classList.contains("createSubarea") ||
        e.target.parentNode.classList.contains("createSubarea")
    ) {
        prepararModalCreateSubarea(
            e.target.classList.contains("createSubarea")
                ? e.target
                : e.target.parentNode
        );
    }
    // ! BOTON ELIMINAR SUBAREA
    else if (
        e.target.classList.contains("deleteSubarea") ||
        e.target.parentNode.classList.contains("deleteSubarea")
    ) {
        btnPulsado = e.target.classList.contains("deleteSubarea")
            ? e.target
            : e.target.parentNode;
        $("#modalDeleteSubarea").modal("show");
    }
    // ! BOTON REESTABLECER SUBAREA
    else if (
        e.target.classList.contains("restoreSubarea") ||
        e.target.parentNode.classList.contains("restoreSubarea")
    ) {
        btnPulsado = e.target.classList.contains("restoreSubarea")
            ? e.target
            : e.target.parentNode;
        $("#modalRestoreSubarea").modal("show");
    }
});

// ! *********************************************  ACTUALIZAR SUBAREA  ******************************************************************
const prepararModalUpdateSubarea = (btn) => {
    btnPulsado = btn;

    updateSubareaFormInput[0].value = document.querySelector(
        ".nested-table-parent > td:nth-child(2) p"
    ).innerText;

    updateSubareaFormInput[1].value =
        btn.parentNode.parentNode.querySelector("td .tr-txt").innerText;

    updateSubareaFormInput[2].value = btn.getAttribute("id-subarea");

    $("#modalUpdateSubarea").modal("show");

    console.log("btn:" + btn.getAttribute("id-subarea"));
};

// ! VALIDAR FORMULARIO
updateSubareaForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let newSubarea = updateSubareaFormInput[1].value;

    if (newSubarea && newSubarea.length > 0) {
        $("#modalUpdateSubarea").modal("hide");
        $("#modalUpdateSubarea2").modal("show");
    }
});

// ! CONFIRMAR EDICION
updateSubareaBtn.addEventListener("click", (e) => {
    e.preventDefault();
    $("#modalUpdateSubarea2").modal("hide");
    let updatedRow = btnPulsado.parentNode.parentNode;

    //prettier-ignore
    // * animacion
    updatedRow.innerHTML = `
        <td colspan="3">
            <img src="gifs/loading2.gif" width = "120px">
        </td>
    `;
    updatedRow.classList.toggle("center-text");

    axios
        .post("/update-subarea", {
            headers: {
                "X-CSRF-TOKEN": _token,
            },
            idSubarea: updateSubareaFormInput[2].value,
            subarea: updateSubareaFormInput[1].value,
        })
        .then((res) => {
            console.log(res.data);
            updatedRow.innerHTML = `
                <td><span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${res.data.subarea}</p></td>
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

// ! *********************************************  CREAR SUBAREA  ******************************************************************
const prepararModalCreateSubarea = (btn) => {
    btnPulsado = btn;
    // createSubareaFo
    createSubareaFormInput[0].value = document.querySelector(
        ".nested-table-parent > td:nth-child(2) p"
    ).innerText;

    // limpiar input
    createSubareaFormInput[1].value = "";

    createSubareaFormInput[2].value = document
        .querySelector(".nested-table-parent")
        .getAttribute("id-area");

    $("#modalCreateSubarea").modal("show");
};
// ! VALIDAR FORMULARIO Y CREAR REGISTRO
createSubareaForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    let newRow = document.createElement("tr");
    let subarea = createSubareaFormInput[1].value;
    let areaId = createSubareaFormInput[2].value;

    if (subarea && subarea.length > 0) {
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
                                <td><span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${subarea}</p></td>
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
            //prettier-ignore
            newRow.innerHTML = `
            <td><span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${subarea}</p></td>
            <td>
                <button class="btn btn-light-primary updateSubarea" id-subarea = "${nuevaSubareaId}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-light-primary deleteSubarea" id-subarea = "${nuevaSubareaId}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;

            insertBefore(
                document.querySelector(".table-subareas-nested tr:first-child"),
                newRow
            );
        }
        $("#modalCreateSubarea").modal("hide");
        createSubareaToast.show();
    }
});

// ! *********************************************  DESCARTAR SUBAREA  ******************************************************************
deleteSubareaBtn.addEventListener("click", async () => {
    let row = btnPulsado.parentNode.parentNode;
    let tbody = row.parentNode;
    let nestedTable = document.querySelector(".table-subareas-nested");

    let res = await deleteSubarea(row.getAttribute("id-subarea"));
    console.log(res.onDeleteSuggestions);

    deleteSubareaToast1.show();

    document.querySelector(
        "#deleteSubareaToast2 .toast-body"
    ).innerHTML = `${res.onDeleteSuggestions} sugerencias/reclamos están utilizando esta subárea.`;
    deleteSubareaToast2.show();

    if (tbody.querySelectorAll("tr").length > 1) {
        row.remove();
        let newRow = document.createElement("tr");
        newRow.classList.add("formato-tabla");
        newRow.setAttribute("id-subarea", res.subarea.id);

        //prettier-ignore
        newRow.innerHTML = `
                <td>
                    <span class="badge badge-secondary">INACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${res.subarea.subarea}</p>
                </td>
                <td>
                    <button class="btn btn-light-primary restoreSubarea" id-subarea = "${res.subarea.id}">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </td>
        `;

        insertAfter(tbody.querySelector("tr:last-child"), newRow);
    } else {
        //prettier-ignore
        console.log("SOLO HAY UNA FILA");
        row.innerHTML = `
            <td>
                <span class="badge badge-secondary">INACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${res.subarea.subarea}</p>
            </td>
            <td>
                <button class="btn btn-light-primary restoreSubarea" id-subarea = "${res.subarea.id}">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
            </td>
        `;
    }
    $("#modalDeleteSubarea").modal("hide");
});

// ! *********************************************  REESTABLECER SUBAREA  ******************************************************************
document
    .getElementById("restoreSubareaBtn")
    .addEventListener("click", async () => {
        let row = btnPulsado.parentNode.parentNode;
        let tbody = row.parentNode;

        let subarea = await restoreSubarea(row.getAttribute("id-subarea"));

        if (tbody.querySelectorAll("tr").length > 1) {
            row.remove();
            let newRow = document.createElement("tr");
            newRow.classList.add("formato-tabla");
            newRow.setAttribute("id-subarea", subarea.id);

            //prettier-ignore
            newRow.innerHTML = `
                <td>
                    <span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${subarea.subarea}</p>
                </td>
                <td>
                    <button class="btn btn-light-primary updateSubarea" id-subarea = "${subarea.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-light-primary deleteSubarea" id-subarea = "${subarea.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;

            insertBefore(tbody.querySelector("tr:first-child"), newRow);
        } else {
            //prettier-ignore
            row.innerHTML = `
                <td>
                    <span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${subarea.subarea}</p>
                </td>
                <td>
                    <button class="btn btn-light-primary updateSubarea" id-subarea = "${subarea.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-light-primary deleteSubarea" id-subarea = "${subarea.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
        }

        $("#modalRestoreSubarea").modal("hide");
    });

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

// ! RECUPERAR TODAS LAS SUBAREAS ASOCIADAS AL AREA SELECCIONADA Y POBLAR LA TABLA
const fetchSubareas = async (a) => {
    //rotar icono
    a.querySelector("i").classList.toggle("rotate-180");
    console.log(a.parentNode.parentNode);

    let subareas = await consultarSubareas(a.getAttribute("id-area"));

    if (subareas && subareas.length > 0) {
        let subareasRows = subareas
            .map((obj) => {
                //prettier-ignore
                return obj.deleted === 0 ? 
                `<tr class = "formato-tabla" id-subarea = "${obj.id}">
                    <td>
                        <span class="badge badge-success">ACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${obj.subarea}</p>
                    </td>
                    <td>
                        <button class="btn btn-light-primary updateSubarea" id-subarea = "${obj.id}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-light-primary deleteSubarea" id-subarea = "${obj.id}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>` 
                : 
                `<tr class = "formato-tabla" id-subarea = "${obj.id}">
                    <td>
                        <span class="badge badge-secondary">INACTIVO</span>&nbsp;&nbsp;&nbsp;&nbsp;<p class = "tr-txt">${obj.subarea}</p>
                    </td>
                    <td>
                        <button class="btn btn-light-primary restoreSubarea" id-subarea = "${obj.id}">
                            <i class="fa-solid fa-arrows-rotate"></i>
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

        insertAfter(a.parentNode.parentNode, newRow);

        //animacion
        window.getComputedStyle(newRow).opacity;
        newRow.className += " nested-table-show";
    }
};

// ! UTILIDADES

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function insertBefore(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode);
}

// ! AXIOS
const consultarSubareas = (idArea) => {
    return new Promise((resolve, reject) => {
        axios
            .get("/get-subareas/" + idArea, {
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
            .post("/create-subarea", {
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
            .post("/delete-subarea", {
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

const restoreSubarea = (subareaId) => {
    return new Promise((resolve, reject) => {
        axios
            .post("/undo-delete-subarea", {
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
