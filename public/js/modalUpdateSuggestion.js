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
                    : e.target.parentNode
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
const prepararModal = async (e) => {
    let suggestion = await consultarSuggestion(e.getAttribute("id-suggestion"));

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

    let elementosSelect = Array.from(
        document
            .querySelector("#modalUpdateSuggestion")
            .querySelectorAll("select")
    );

    for (let i = 0; i < 6; i++) {
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

    btnpulsado = e;
    idSuggestion = e.getAttribute("id-suggestion");

    document.getElementById("kt_td_picker_basic_input").value = fechaLegible(
        values[values.length - 1]
    );

    document.getElementById("suggestionTextarea").value =
        values[values.length - 2];

    // TODO: Validar la existencia de subareas
    // let subareas = (await consultarSubareas(8))
    //     .map((subarea) => {
    //         return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
    //     })
    //     .join("");
    let subareas = (await consultarSubareas(suggestion.area_id))
        .map((subarea) => {
            return `<option value = "${subarea.id}">${subarea.subarea}</option>`;
        })
        .join("");

    // * problar dropdown
    if (subareas.length > 0) {
        // poblar dropdown son subareas
        elementosSelect[elementosSelect.length - 1].innerHTML =
            `<option value="">Sin Designar</option>` + subareas;
        // mostrar dropdown
        elementosSelect[elementosSelect.length - 1].style.display = "block";
        // desctivar alerta por defecto
        alertaUpdateSuggesion.style.display = "none";

        // * seleccionar subarea
        if (suggestion.subarea_id) {
            // seleccionar option
            elementosSelect[elementosSelect.length - 1].querySelector(
                `option[value="${suggestion.subarea_id}"]`
            ).selected = true;
            //desactivar alerta
            alertaUpdateSuggesion.style.display = "none";
        } else {
            //seleccionar option nulo si la sugerencia no cuenta todavia con un subarea_id
            elementosSelect[elementosSelect.length - 1].selectedIndex = 0;
            // alertaUpdateSuggesion.innerText =
            //     "Aún no se ha asiganado una subárea al presente reclamo/sugerencia.";
            // alertaUpdateSuggesion.className = "";
            // alertaUpdateSuggesion.classList.add("alert", "alert-primary");
            // alertaUpdateSuggesion.style.display = "block";
            mostrarAlerta(
                alertaUpdateSuggesion,
                "Aún no se ha asiganado una subárea al presente reclamo/sugerencia.",
                "primary"
            );
        }
    } else {
        elementosSelect[elementosSelect.length - 1].style.display = "none";
        elementosSelect[elementosSelect.length - 1].selectedIndex = 0;

        // alertaUpdateSuggesion.className = "";
        // alertaUpdateSuggesion.classList.add("alert", "alert-danger");
        // alertaUpdateSuggesion.innerText = "sin subareas";
        // alertaUpdateSuggesion.style.display = "block";
        mostrarAlerta(
            alertaUpdateSuggesion,
            "El área seleccionada aún no cuenta con subáreas asignadas.",
            "danger"
        );
    }

    // elementosSelect[elementosSelect.length - 1].innerHTML = "";

    console.log(subareas);

    $("#modalUpdateSuggestion").modal("show");

    // elementosSelect.forEach((select, i) => {});

    // let values = [];
    // let elementosSelect = [];

    // e.parentNode.parentNode
    //     .querySelectorAll("td:not(:last-child)")
    //     .forEach((element) => {
    //         values.push(element.innerText);
    //     });

    // document
    //     .querySelector(
    //         "#modalUpdateSuggestion .modal-dialog .modal-content .modal-body div"
    //     )
    //     .querySelectorAll("select")
    //     .forEach((select) => elementosSelect.push(select));

    // elementosSelect.forEach((elementoSelect, i) => {
    //     if (i === elementosSelect.length - 1) {
    //         elementoSelect.querySelector(
    //             `option[value="${values[i]}"]`
    //         ).selected = true;
    //     }
    //     if (elementoSelect.querySelector(`option[value="${values[i]}"]`)) {
    //         elementoSelect.querySelector(
    //             `option[value="${values[i]}"]`
    //         ).selected = true;
    //         elementoSelect.parentNode.style.display = "block";
    //     }
    //     if (!elementoSelect.querySelector(`option[value="${values[i]}"]`)) {
    //         elementoSelect.parentNode.style.display = "none";
    //         elementoSelect.selectedIndex = -1;
    //     }
    // });

    // console.log(values);
    // console.log(elementosSelect);

    // btnpulsado = e;
    // idSuggestion = e.getAttribute("id-suggestion");

    // document.getElementById("kt_td_picker_basic_input").value =
    //     values[values.length - 1];

    // document.getElementById("suggestionTextarea").value =
    //     values[values.length - 2];

    // $("#modalUpdateSuggestion").modal("show");
};

// * poblar dropdown en tiempo real
document
    .getElementById("modalUpdateSelectArea")
    .addEventListener("change", async (e) => {
        console.log(e.target.value);

        let subareas = (await consultarSubareas(e.target.value))
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
                "El área seleccionada aún no cuenta con subáreas asignadas.",
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

    // actualizar frontend
    // btnpulsado.parentNode.parentNode
    //     .querySelectorAll("td:not(:last-child)")
    //     .forEach((td, i) => {
    //         td.innerText = valoresActualizados[i];
    //     });

    valoresSubida = valoresActualizados.map((v) => (v === "" ? null : v));
    console.log(valoresSubida);

    return;

    $("#modalUpdateSuggestion").modal("hide");
    $("#modalUpdateSuggestion2").modal("show");

    axios
        .post("https://buzon-sugerencias.bo/update-suggestion", {
            idSuggestion,
            valoresSubida,
            _token,
        })
        .then((response) => {
            console.log("Respuesta del servidor:", response.data);
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
            btnpulsado.parentNode.parentNode.remove();
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
