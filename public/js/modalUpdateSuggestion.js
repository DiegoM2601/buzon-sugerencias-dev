// const tempusDominus = document.getElementById("kt_td_picker_basic_input");

let btnpulsado;

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
    document
        .querySelector(
            "#modalUpdateSuggestion .modal-dialog .modal-content .modal-body div"
        )
        .querySelectorAll("select")
        .forEach((select) => valoresActualizados.push(select.value));

    console.log(valoresActualizados);

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

    $("#modalUpdateSuggestion").modal("hide");
};

document
    .getElementById("restoreSuggestionBtn")
    .addEventListener("click", (e) => {
        // $("#modalUpdateSuggestion").modal("hide");
        btnpulsado.click();
    });

document
    .getElementById("updateSuggestionBtn")
    .addEventListener("click", (e) => {
        actualizarRegistros();
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
