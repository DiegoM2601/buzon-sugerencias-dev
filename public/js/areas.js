const ancla = document.getElementById("ancla");

ancla.addEventListener("click", (e) => {
    e.preventDefault();
    ancla.querySelector("i").classList.toggle("rotate-180");

    // document.getElementById("row-nested").style.display = "table-row";
    document.getElementById("row-nested").classList.toggle("hide-row");
});
