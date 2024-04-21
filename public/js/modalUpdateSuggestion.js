const _token = document.querySelector("input[name=_token]").value;
let btnpulsado;
let idSuggestion;
let valoresSubida;

const alertaUpdateSuggesion = document.getElementById(
    "alerta-updateSuggestion"
);

// ! ************************************************************ NOTIFICACIONES TOAST
const toast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("updateSuggestionToast")
);
const toastParams = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("searchParamsToast")
);
const toastDelete = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("deleteSuggestionToast")
);

// ! ************************************************************ EVENTOS DE TABLA
document
    .getElementById("kt_permissions_table_wrapper")
    .addEventListener("click", (e) => {
        // Boton editar
        if (
            e.target.classList.contains("updateRegisterBtn") ||
            e.target.parentNode.classList.contains("updateRegisterBtn")
        ) {
            prepararModal(
                e.target.classList.contains("updateRegisterBtn")
                    ? e.target
                    : e.target.parentNode,
                true
            );
        }
        if (
            e.target.classList.contains("restoreRegisterBtn") ||
            e.target.parentNode.classList.contains("restoreRegisterBtn")
        ) {
            prepararModal(
                e.target.classList.contains("restoreRegisterBtn")
                    ? e.target
                    : e.target.parentNode,
                false
            );
        }

        // Boton eliminar
        if (
            e.target.classList.contains("deleteRegisterBtn") ||
            e.target.parentNode.classList.contains("deleteRegisterBtn")
        ) {
            $("#modalDeleteSuggestion").modal("show");
            btnpulsado = e.target.classList.contains("deleteRegisterBtn")
                ? e.target
                : e.target.parentNode;
        }
    });

// ! ************************************************************ MODAL EDITAR
const prepararModal = async (e, active) => {
    btnpulsado = e;
    idSuggestion = e.getAttribute("id-suggestion");

    let suggestion = await consultarSuggestion(idSuggestion);
    let modal = document.querySelector("#modalUpdateSuggestion");

    let values = [
        suggestion.sede,
        suggestion.categoria,
        suggestion.by_,
        suggestion.carrera,
        suggestion.semestre,
        suggestion.area_id,
        suggestion.sugerencia,
        suggestion.created_at,
    ];

    let elementosSelect = Array.from(modal.querySelectorAll("select"));

    let footerBtns = modal.querySelectorAll(".modal-footer button");

    // ! poblar formulario
    //elementos dropdown: sede, categoria, particpante, carrera y semestre
    for (let i = 0; i < 5; i++) {
        if (elementosSelect[i].querySelector(`option[value="${values[i]}"]`)) {
            elementosSelect[i].querySelector(
                `option[value="${values[i]}"]`
            ).selected = true;

            elementosSelect[i].parentNode.style.display = "block";
        } else {
            elementosSelect[i].parentNode.style.display = "none";
            elementosSelect[i].selectedIndex = -1;
        }
    }
    // input fecha
    document.getElementById("kt_td_picker_basic_input").value = fechaLegible(
        values[values.length - 1]
    );
    // textarea comentario
    document.getElementById("suggestionTextarea").value =
        values[values.length - 2];

    // ! areas
    let areas = await consultarAreas();
    let areasActivas = areas.filter((area) => {
        if (area.deleted === 0) {
            return area;
        }
    });

    let estadoArea = areasActivas.find((obj) => obj.id === suggestion.area_id);

    if (areasActivas.length > 0 && estadoArea) {
        let areasFormato = areasActivas
            .map((area) => {
                return `<option value = "${area.id}">${area.area}</option>`;
            })
            .join("");

        elementosSelect[elementosSelect.length - 2].innerHTML = areasFormato;

        elementosSelect[elementosSelect.length - 2].querySelector(
            `option[value="${suggestion.area_id}"]`
        ).selected = true;
    } else if (areasActivas.length > 0 && !estadoArea) {
        let areasFormato = areasActivas
            .map((area) => {
                return `<option value = "${area.id}">${area.area}</option>`;
            })
            .join("");

        elementosSelect[elementosSelect.length - 2].innerHTML = areasFormato;

        // ! añadir una nueva opcion con el elemento deprecado
        let ref =
            elementosSelect[elementosSelect.length - 2].querySelector(
                "option:last-child"
            );

        var areaIndex = areas.findIndex(
            (area) => area.id === suggestion.area_id
        );

        let newOption = document.createElement("option");
        newOption.value = areas[areaIndex].id;
        newOption.classList.add("text-danger");
        newOption.innerText = `${areas[areaIndex].area} (Área Deprecada)`;

        insertAfter(ref, newOption);

        newOption.selected = true;
    } else if (areasActivas.length === 0 && !estadoArea) {
        let areaInactiva = areas.find((obj) => obj.id === suggestion.area_id);

        // poblar dropdown con unicamente 2 opciones
        // prettier-ignore
        elementosSelect[elementosSelect.length - 2].innerHTML = `
        <option class = "text-danger" value = "${areaInactiva.id}" selected>${areaInactiva.area} (Área Deprecada)</option>
        `;

        console.log("ejecutado 3er if");
    }

    // ! subareas

    if (suggestion.subarea_id) {
        // * poblar drowpdown
        let subareas = await consultarSubareas(suggestion.area_id);

        let subareasActivas = subareas.filter((subarea) => {
            if (subarea.deleted === 0) {
                return subarea;
            }
        });

        // * comprobar si la subarea esta activa o no
        // * si subarea tiene un valor diferente de null o undefined eso quiero decir que la subarea esta activa
        let estadoSubarea = subareasActivas.find(
            (obj) => obj.id === suggestion.subarea_id
        );

        if (subareasActivas.length > 0 && estadoSubarea) {
            let subareasFormato = subareasActivas
                .map((subarea) => {
                    return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
                })
                .join("");

            // poblar dropdown son subareas
            elementosSelect[elementosSelect.length - 1].innerHTML =
                `<option value="">Sin Designar</option>` + subareasFormato;
            // mostrar dropdown
            elementosSelect[elementosSelect.length - 1].style.display = "block";

            // ! seleccionar subarea
            elementosSelect[elementosSelect.length - 1].querySelector(
                `option[value="${suggestion.subarea_id}"]`
            ).selected = true;

            // desctivar alerta por defecto
            alertaUpdateSuggesion.style.display = "none";
        } else if (subareasActivas.length > 0 && !estadoSubarea) {
            let subareasFormato = subareasActivas
                .map((subarea) => {
                    return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
                })
                .join("");

            // poblar dropdown son subareas
            elementosSelect[elementosSelect.length - 1].innerHTML =
                `<option value="">Sin Designar</option>` + subareasFormato;
            // mostrar dropdown
            elementosSelect[elementosSelect.length - 1].style.display = "block";

            // ! añadir una nueva opcion con el elemento deprecado
            let ref =
                elementosSelect[elementosSelect.length - 1].querySelector(
                    "option:last-child"
                );

            var subareaIndex = subareas.findIndex(
                (subarea) => subarea.id === suggestion.subarea_id
            );

            let newOption = document.createElement("option");
            newOption.value = subareas[subareaIndex].id;
            newOption.classList.add("text-danger");
            newOption.innerText = `${subareas[subareaIndex].subarea} (Subárea Deprecada)`;

            insertAfter(ref, newOption);

            newOption.selected = true;

            mostrarAlerta(
                alertaUpdateSuggesion,
                "El presente registro está utilizando datos que han sido dados de baja.",
                "warning"
            );
        } else if (subareasActivas.length === 0 && !estadoSubarea) {
            let subareaInactiva = subareas.find(
                (obj) => obj.id === suggestion.subarea_id
            );

            // poblar dropdown con unicamente 2 opciones
            // prettier-ignore
            elementosSelect[elementosSelect.length - 1].innerHTML = `
            <option value="">Sin Designar</option>
            <option class = "text-danger" value = "${subareaInactiva.id}" selected>${subareaInactiva.subarea} (Subárea Deprecada)</option>
            `;
            // mostrar dropdown
            elementosSelect[elementosSelect.length - 1].style.display = "block";

            mostrarAlerta(
                alertaUpdateSuggesion,
                "El presente registro está utilizando datos que han sido dados de baja.",
                "warning"
            );
        }
    }
    // ! la sugerencia no cuenta con ninguna subarea asignada, no cuenta ni con una subarea activa ni tampoco con una subarea inactiva, ninguna de las dos
    else {
        // * poblar el dropwdown con subareas activas unicamente
        let subareas = (await consultarSubareas(suggestion.area_id)).filter(
            (subarea) => {
                if (subarea.deleted === 0) {
                    return subarea;
                }
            }
        );

        if (subareas.length > 0) {
            elementosSelect[elementosSelect.length - 1].style.display = "block";

            let subareasFormato = subareas
                .map((subarea) => {
                    return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
                })
                .join("");

            // poblar dropdown son subareas
            elementosSelect[elementosSelect.length - 1].innerHTML =
                `<option value="">Sin Designar</option>` + subareasFormato;

            mostrarAlerta(
                alertaUpdateSuggesion,
                "Aún no se ha asiganado una subárea al presente reclamo/sugerencia.",
                "primary"
            );
        } else {
            elementosSelect[elementosSelect.length - 1].style.display = "none";
            elementosSelect[elementosSelect.length - 1].selectedIndex = 0;

            mostrarAlerta(
                alertaUpdateSuggesion,
                "El área seleccionada no cuenta con subáreas disponibles.",
                "danger"
            );
        }
    }

    // ! OPCIONES ALTERNAS ENTRE FORMULARIO DE EDICION Y FORMULARIO DE REESTABLECIMIENTO
    // Encabezado
    modal.querySelector(".modal-header h1").innerText = "Actualizar Registro";

    // BOTONES
    footerBtns[0].style.display = "block";
    footerBtns[1].style.display = "none";

    // Campos editables del formulario
    elementosSelect[1].disabled = false;
    elementosSelect[5].disabled = false;
    elementosSelect[6].disabled = false;

    document.getElementById("restoreSuggestionBtn").style.display = "block";

    if (!active) {
        // Desactivar todos los campos
        elementosSelect.forEach((e) => {
            e.disabled = true;
        });

        footerBtns[0].style.display = "none";
        footerBtns[1].style.display = "block";

        document.getElementById("restoreSuggestionBtn").style.display = "none";

        modal.querySelector(".modal-header h1").innerText =
            "Reestablecer Registro";
    }

    $("#modalUpdateSuggestion").modal("show");
};

// * poblar dropdown en tiempo real
document
    .getElementById("modalUpdateSelectArea")
    .addEventListener("change", async (e) => {
        console.log(e.target.value);

        // mostrar areas activas unicamente
        let subareas = (await consultarSubareas(e.target.value))
            .filter((subarea) => {
                if (subarea.deleted === 0) {
                    return subarea;
                }
            })
            .map((subarea) => {
                return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
            })
            .join("");

        let subareasSelect =
            e.target.parentNode.nextElementSibling.querySelector("select");

        if (subareas.length > 0) {
            subareasSelect.innerHTML =
                `<option value="">Sin Designar</option>` + subareas;
            subareasSelect.style.display = "block";
            alertaUpdateSuggesion.style.display = "none";
        } else {
            subareasSelect.style.display = "none";
            subareasSelect.selectedIndex = 0;
            mostrarAlerta(
                alertaUpdateSuggesion,
                "El área seleccionada no cuenta con subáreas disponibles.",
                "danger"
            );
        }
    });

const mostrarAlerta = (alerta, mensaje, color) => {
    alerta.innerText = mensaje;
    alerta.className = "";
    alerta.classList.add("alert", `alert-${color}`);
    alerta.style.display = "block";
};

const consultarSuggestion = (id) => {
    return new Promise((resolve, reject) => {
        axios
            .get("https://buzon-sugerencias.bo/get-suggestion/" + id, {
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

const consultarAreas = () => {
    return new Promise((resolve, reject) => {
        axios
            .get("https://buzon-sugerencias.bo/get-areas", {
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

const actualizarRegistros = () => {
    let valoresActualizados = [];
    valoresSubida = [];
    document
        .querySelector(
            "#modalUpdateSuggestion .modal-dialog .modal-content .modal-body div"
        )
        .querySelectorAll("select")
        .forEach((select) => valoresActualizados.push(select.value));

    valoresActualizados.push(
        document.getElementById("suggestionTextarea").value
    );
    valoresActualizados.push(
        document.getElementById("kt_td_picker_basic_input").value
    );

    valoresSubida = valoresActualizados.map((v) => (v === "" ? null : v));
    console.log(valoresSubida);

    axios
        .post("https://buzon-sugerencias.bo/update-suggestion", {
            idSuggestion,
            valoresSubida,
            _token,
        })
        .then((response) => {
            console.log("Respuesta del servidor:", response.data);

            //! actualizar frontend

            //prettier-ignore
            btnpulsado.parentNode.parentNode.innerHTML = `
            <td>${response.data.sede}</td>
            <td>${response.data.categoria}</td>
            <td>${response.data.by_}</td>
            <td>${response.data.carrera === null ? "" : response.data.carrera}</td>
            <td>${response.data.semestre === null ? "" : response.data.semestre}</td>
            <td>${response.data.objeto_area.area}</td>
            <td>${response.data.subarea ? response.data.subarea.subarea : `<span class="badge badge-primary">Sin Asignar</span>`}</td>
            <td>
                <p class = "truncate">${response.data.sugerencia}</p>
            </td>
            <td>${fechaLegible(response.data.created_at)}</td>
            <td><span class="badge badge-success">ACTIVO</span></td>
            <td class="d-flex bd-highlight">
                <button class="btn btn-light-primary updateRegisterBtn m-1" id-suggestion = "${response.data.id}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-light-primary deleteRegisterBtn m-1" id-suggestion = "${response.data.id}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
            `;

            toast.show();
        })
        .catch((error) => {
            console.error("Error al realizar la solicitud:", error);
        });
};

const deshacerEliminacion = () => {
    axios
        .post("https://buzon-sugerencias.bo/undo-delete-register", {
            idSuggestion,
            _token,
        })
        .then((response) => {
            console.log("Respuesta del servidor:", response.data);

            let deletedRow = btnpulsado.parentNode.parentNode;
            deletedRow.classList.toggle("deleted-row");
            let deletedColumns = deletedRow.querySelectorAll("td");

            //prettier-ignore
            deletedColumns[deletedColumns.length - 1].innerHTML = `
            <button class="btn btn-light-primary updateRegisterBtn m-1" id-suggestion = "${idSuggestion}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-light-primary deleteRegisterBtn m-1" id-suggestion = "${idSuggestion}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            deletedColumns[
                deletedColumns.length - 2
            ].innerHTML = `<span class="badge badge-success">ACTIVO</span>`;

            $("#modalUpdateSuggestion").modal("hide");
            toast.show();
        })
        .catch((error) => {
            console.error("Error al realizar la solicitud:", error);
        });
};

// * Abrir modal de confirmación
document
    .getElementById("updateSuggestionBtn")
    .addEventListener("click", (e) => {
        $("#modalUpdateSuggestion").modal("hide");
        $("#modalUpdateSuggestion2").modal("show");
    });

// * Confirmar la actualización
document.getElementById("confirmUpdate").addEventListener("click", () => {
    actualizarRegistros();
    $("#modalUpdateSuggestion2").modal("hide");
});

// * Deshacer la eliminacion del registro
document.getElementById("undoDeleteBtn").addEventListener("click", () => {
    deshacerEliminacion();
});

// * Restaurar modal a valores originales
document
    .getElementById("restoreSuggestionBtn")
    .addEventListener("click", (e) => {
        btnpulsado.click();
    });

// ! ****************************************************************** MODAL ELIMINAR
document.getElementById("confirmDeletion").addEventListener("click", () => {
    $("#modalDeleteSuggestion").modal("hide");
    eliminarRegistros();
});

const eliminarRegistros = () => {
    axios
        .post("https://buzon-sugerencias.bo/delete-register", {
            headers: {
                "X-CSRF-TOKEN": _token,
            },
            idSuggestion: btnpulsado.getAttribute("id-suggestion"),
        })
        .then(function (response) {
            console.log(response.data);
            // btnpulsado.parentNode.parentNode.remove();

            let deletedRow = btnpulsado.parentNode.parentNode;
            deletedRow.classList.toggle("deleted-row");
            let deletedColumns = deletedRow.querySelectorAll("td");

            //prettier-ignore
            deletedColumns[deletedColumns.length - 1].innerHTML = `
            <button class="btn btn-light-primary restoreRegisterBtn m-1 table-suggestions-btn" id-suggestion = "${btnpulsado.getAttribute("id-suggestion")}">
                <i class="fa-solid fa-arrows-rotate"></i>
            </button> 
            `;
            deletedColumns[
                deletedColumns.length - 2
            ].innerHTML = `<span class="badge badge-secondary">INACTIVO</span>`;

            toastDelete.show();
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
};

// ! **************************************************************** UTILIDADES
function fechaLegible(fecha) {
    let f = new Date(fecha);
    let anio = f.getFullYear();

    // aumentar ceros en los dias y meses de un solo digito
    var mes =
        f.getMonth() + 1 < 10 ? "0" + (f.getMonth() + 1) : f.getMonth() + 1;
    var dia = f.getDate() < 10 ? "0" + f.getDate() : f.getDate();
    let formato1 = `${anio}-${mes}-${dia}`;

    //! establecer zona horaria
    f.setUTCHours(f.getUTCHours() - 4);

    var hora = f.getUTCHours();
    var minuto = f.getUTCMinutes();
    var segundo = f.getUTCSeconds();
    var formato2 =
        hora.toString().padStart(2, "0") +
        ":" +
        minuto.toString().padStart(2, "0") +
        ":" +
        segundo.toString().padStart(2, "0");

    return `${formato1} ${formato2}`;
}
function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
