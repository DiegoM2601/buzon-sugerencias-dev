const _token = document.querySelector("input[name=_token]").value;
let btnpulsado;
let idSuggestion;
let valoresSubida;

// let updateSuggestionToast = new bootstrap.Toast(
//     document.getElementById("updateSuggestionToast")
// );
const toast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("updateSuggestionToast")
);

const prepararModal = (e) => {
    let values = [];
    let elementosSelect = [];
    // document.getElementById("restoreSuggestionBtn").setAttribute("td", e);

    e.parentNode.parentNode
        .querySelectorAll("td:not(:last-child)")
        .forEach((element) => {
            values.push(element.innerText);
        });
    //[ "LPZ", "Reclamo", "Estudiante", "ADM", "7", "Clínica UNIFRANZ", "lorem ipsum", "2024-02-28 11:33:45", "{botonesUpdate y Delete}" ]

    document
        .querySelector(
            "#modalUpdateSuggestion .modal-dialog .modal-content .modal-body div"
        )
        .querySelectorAll("select")
        .forEach((select) => elementosSelect.push(select));

    elementosSelect.forEach((elementoSelect, i) => {
        // elementoSelect.querySelector(`option[value="${values[i]}"]`).selected =
        //     "selected";
        if (elementoSelect.querySelector(`option[value="${values[i]}"]`)) {
            elementoSelect.querySelector(
                `option[value="${values[i]}"]`
            ).selected = true;
            elementoSelect.parentNode.style.display = "block";
        } else {
            elementoSelect.parentNode.style.display = "none";
            elementoSelect.selectedIndex = -1;
        }
    });

    console.log(values);
    console.log(elementosSelect);

    btnpulsado = e;
    idSuggestion = e.getAttribute("id-suggestion");

    document.getElementById("kt_td_picker_basic_input").value =
        values[values.length - 1];

    document.getElementById("suggestionTextarea").value =
        values[values.length - 2];

    $("#modalUpdateSuggestion").modal("show");
    // let info = e.target.parentNode.parentNode
    //     .querySelectorAll("td")
    //     .map((valor) => valor.innerText);

    // console.log(info);
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

    btnpulsado.parentNode.parentNode
        .querySelectorAll("td:not(:last-child)")
        .forEach((td, i) => {
            td.innerText = valoresActualizados[i];
        });

    console.log(valoresActualizados);
    // [ "LPZ", "Sugerencia", "Docente", "", "", "Anfitriones/Tutores/Ayudantes/Hnos Mayores", "mejorar", "2024-03-07 15:36:09" ]

    valoresSubida = valoresActualizados.map((v) => (v === "" ? null : v));
    console.log(valoresSubida);

    $("#modalUpdateSuggestion").modal("hide");
    $("#modalUpdateSuggestion2").modal("show");

    axios
        .post("https://buzon-sugerencias.bo/update-suggestion", {
            idSuggestion,
            valoresSubida,
            _token,
        })
        .then((response) => {
            // Maneja la respuesta si la solicitud fue exitosa
            console.log("Respuesta del servidor:", response.data);
            toast.show();
        })
        .catch((error) => {
            // Maneja el error si la solicitud falla
            console.error("Error al realizar la solicitud:", error);
        });

    // $("#modalUpdateSuggestion").modal("hide");
};

document.getElementById("confirmUpdate").addEventListener("click", () => {
    actualizarRegistros();
    $("#modalUpdateSuggestion2").modal("hide");
});

document.getElementById("dismissUpdate").addEventListener("click", () => {
    $("#modalUpdateSuggestion2").modal("hide");
});

document
    .getElementById("restoreSuggestionBtn")
    .addEventListener("click", (e) => {
        // $("#modalUpdateSuggestion").modal("hide");
        btnpulsado.click();
    });

document
    .getElementById("updateSuggestionBtn")
    .addEventListener("click", (e) => {
        $("#modalUpdateSuggestion").modal("hide");
        $("#modalUpdateSuggestion2").modal("show");

        // axios
        //     .post("https://buzon-sugerencias.bo/update-suggestion", {
        //         num: 45,
        //         _token,
        //     })
        //     .then((response) => {
        //         // Maneja la respuesta si la solicitud fue exitosa
        //         console.log("Respuesta del servidor:", response.data);
        //     })
        //     .catch((error) => {
        //         // Maneja el error si la solicitud falla
        //         console.error("Error al realizar la solicitud:", error);
        //     });
    });

document
    .getElementById("kt_permissions_table")
    .addEventListener("click", (e) => {
        if (
            e.target.classList.contains("updateRegisterBtn") ||
            e.target.parentNode.classList.contains("updateRegisterBtn")
        ) {
            prepararModal(
                e.target.classList.contains("updateRegisterBtn")
                    ? e.target
                    : e.target.parentNode
            );
            // alert("algo");
            // document.getElementById("ejemploEjemplo").selectedIndex = 2;
            // $("#modalUpdateSuggestion").modal("show");
        }
    });

// ! ******************************************************************

document.getElementById("buscarBtn").addEventListener("click", (e) => {
    e.preventDefault();

    const elementosFormulario = Array.from(
        document.querySelectorAll("#searchForm select")
    );
    elementosFormulario.push(document.getElementById("datefilter"));
    const valores = elementosFormulario.map((e) =>
        e.value === "0" ? null : e.value
    );

    const consulta = {
        sede: valores[0],
        semestre: valores[1],
        area: valores[2],
        categoria: valores[3],
        by_: valores[4],
        datefilter: valores[5],
    };

    // const consulta = {
    //     sede: "SCZ",
    //     semestre: "2",
    //     area: "Anfitriones/Tutores/Ayudantes/Hnos Mayores",
    //     by_: "Estudiante",
    //     categoria: "Sugerencia",
    //     datefilter: "01/02/2024 - 13/03/2024",
    // };

    console.log(consulta);

    axios
        .post("https://buzon-sugerencias.bo/search-parameters", {
            consulta,
            _token,
        })
        .then((res) => {
            // console.log(res.data);
            let td = res.data.map((suggestion) => {
                //prettier-ignore
                return `<tr>
                            <td>${suggestion.sede}</td>
                            <td>${suggestion.categoria}</td>
                            <td>${suggestion.by_}</td>
                            <td>${suggestion.carrera === null ? "" : suggestion.carrera}</td>
                            <td>${suggestion.semestre === null ? "" : suggestion.semestre}</td>
                            <td>${suggestion.area}</td>
                            <td>${suggestion.sugerencia}</td>
                            <td>${fechaLegible(suggestion.created_at)}</td>
                            <td>
                                <button class="btn btn-warning updateRegisterBtn"
                                    id-suggestion = "${suggestion.id}"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteSuggestion"><i
                                        class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>`;
            });
            let suggestions = td.join("");
            console.log(suggestions);

            document.querySelector("#kt_permissions_table tbody").innerHTML =
                "";
            document.querySelector("#kt_permissions_table tbody").innerHTML =
                suggestions;

            // remover la paginacion de bootstrap que permanece estatica despues de concretar la busqueda
            document.querySelector(
                "#kt_permissions_table"
            ).nextElementSibling.innerHTML = "";
        })
        .catch((error) => {
            console.error("Error al realizar la solicitud:", error);
        });
});

function fechaLegible(fecha) {
    let f = new Date(fecha);
    let anio = f.getFullYear();
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
