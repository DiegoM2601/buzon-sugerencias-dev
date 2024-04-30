const searchParams = () => {
    const elementosFormulario = Array.from(
        document.querySelectorAll("#searchForm select")
    );
    elementosFormulario.push(document.getElementById("datefilter"));
    const valores = elementosFormulario.map((e) =>
        e.value === "0" ? null : e.value
    );

    const consulta = {
        search_sede: valores[0],
        search_semestre: valores[1],
        search_area: valores[2],
        search_by: valores[4],
        search_categoria: valores[3],
        datefilter: valores[5],
    };
    console.log(consulta);
    axios
        .get("/", {
            headers: {
                "X-CSRF-TOKEN": _token,
                AXIOS: "",
            },
            params: {
                search_sede: valores[0],
                search_semestre: valores[1],
                search_area: valores[2],
                search_by: valores[4],
                search_categoria: valores[3],
                datefilter: valores[5],
            },
        })
        .then(function (response) {
            console.log("Respuesta consulta:", response.data);

            document.getElementById("table-suggestions").innerHTML =
                response.data;
            document.getElementById("table-suggestions").innerHTML =
                response.data;

            toastParams.show();
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
};
// ! PRESCINDIR DEL BOTÓN DE BUSCAR
const selectores = document.querySelectorAll(".selectSearchParam");
console.log(selectores);
selectores.forEach((selector) => {
    selector.addEventListener("change", (e) => {
        searchParams();
        /**
         * ! El evento change en el datetimepicker se configura directo en el script de home.blade.php
         */
    });
});

// ! PAGINACIÓN EN TIEMPO REAL
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href");
    record(page);
});

function record(page) {
    axios
        .get(page, {
            headers: {
                "X-CSRF-TOKEN": _token,
                AXIOS: "",
            },
        })
        .then(function (response) {
            console.log("Respuesta:", response.data);
            document.getElementById("table-suggestions").innerHTML =
                response.data;
            document.getElementById("table-suggestions").innerHTML =
                response.data;
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
}
