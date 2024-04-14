const ancla = document.getElementById("ancla");
const _token = document.querySelector("input[name=_token]").value;
const updateSubareaToast = bootstrap.Toast.getOrCreateInstance(
    document.getElementById("updateSubareaToast")
);
let btnPulsado;

// formulario modal update subarea
const updateSubareaForm = document.querySelectorAll(".update-subarea-txt");
const updateSubareaBtn = document.getElementById("updateSubareaBtn");

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
        prepararModalSubarea(
            e.target.classList.contains("updateSubarea")
                ? e.target
                : e.target.parentNode
        );
    }
});

const prepararModalSubarea = (btn) => {
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
            <td></td>
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
        newRow.innerHTML = `
        <div class="alert alert-secondary" role="alert">
            Esta área aún no cuenta con subáreas asignadas.
        </div>
        `;

        //prettier-ignore
        newRow.innerHTML = `
            <td></td>
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
