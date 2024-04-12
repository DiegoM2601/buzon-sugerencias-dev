const ancla = document.getElementById("ancla");
const _token = document.querySelector("input[name=_token]").value;

// ancla.addEventListener("click", async (e) => {
//     e.preventDefault();
//     ancla.querySelector("i").classList.toggle("rotate-180");

//     // document.getElementById("row-nested").style.display = "table-row";
//     document.getElementById("row-nested").classList.toggle("hide-row");

//     let algo = await consultarSubareas(8);
//     console.log(algo);
// });

document.getElementById("table-areas").addEventListener("click", (e) => {
    if (
        e.target.classList.contains("collapse-subareas") ||
        e.target.parentNode.classList.contains("collapse-subareas")
    ) {
        e.preventDefault();
        // e.target.querySelector("i").classList.toggle("rotate-180");
        // e.preventDefault();

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
});

const collapseAll = () => {
    var nestedTableRows = document
        .getElementById("table-areas")
        .querySelectorAll("tr.nested-table");
    // console.log(nestedTableRows);

    var nestedTableParents = document
        .getElementById("table-areas")
        .querySelectorAll("tr.nested-table-parent");

    // ! colapsar el resto
    if (nestedTableRows.length > 0) {
        nestedTableRows.forEach((e) => {
            e.remove();
        });

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

    let subareas = await consultarSubareas(69);

    if (subareas && subareas.length > 0) {
        let subareasRows = subareas
            .map((obj) => {
                //prettier-ignore
                return `
                <tr class = "formato-tabla" id-subarea = "${obj.id}">
                    <td>${obj.subarea}</td>
                    <td>
                        <button class="btn btn-light-primary" id-suggestion = "3"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-light-primary" id-suggestion = "3"><i
                                class="fa-solid fa-trash"></i></button>
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
