const laPaz = turf.polygon([sedeLaPaz.features[0].geometry.coordinates[0]]);
const elAlto = turf.polygon([sedeElAlto.features[0].geometry.coordinates[0]]);

function activarGeolocalizacion() {
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };

    // * capturar por una única vez la ubicación actual del usuario
    var watchID = navigator.geolocation.getCurrentPosition(
        geoSuccess,
        geoError,
        options
    );
}

// ! GEOLOCALIZACION
const geoSuccess = async (posicion) => {
    ocultarSteps();
    $("#geo-load").show();

    //TODO: Usar un gif de cargando en lo que se ejecuta esta función porque aveces la pantalla queda en blanco mucho tiempo
    //TODO: Por alguna razon en firefox movil detecta que el permiso de ubicación se desactiva a cada rato, esto no pasa en Opera, tampoco en Chrome
    /**
     * Cuando una aplicación está utilizando el GPS, recién el ícono aparece en el pantel de notificaciones. Eso pasa con Opera, sin embargo, con Firefox el ícono nunca aparece.
     */

    let ubicacion = await determinarSedeActual(posicion);

    // ! EL USUARIO SE HALLA AL INTERIOR DE UNA SEDE
    if (ubicacion) {
        document.getElementById("geo-sede-detectada").innerText =
            "ESTÁS EN LA SEDE " + ubicacion.sede;

        document.getElementById(
            "geo-animacion"
        ).innerHTML = `<img src="/gifs/check-list.gif" width="200px">`;

        document.getElementById("geo-load-msj").innerText = "";

        await delay(3000);

        ocultarSteps();
        $("#step-1").show();

        // TODO: OCULTAR TODAS VENTANAS ANTES DE MOSTRAR LA VENTANA DE TUTORIAL
    }
    // ! EL USUARIO ***NO*** SE HALLA EN NINGUNA SEDE
    else {
        window.location.href = "/error?sede";
    }
};

// ! REDIRIGIR A /HELP
$("#btnAyuda").click(function () {
    window.location.href = "/help";
});

// ! VOLVER AL FORMULARIO
$("#btnGeoInstrucciones").click(function () {
    window.location = window.location.href.split("?")[0];
});

// ! EL USUARIO HA NEGADO EL ACCESO A LA UBICACION
const geoError = (error) => {
    window.location.href = "/error?permiso";
};

// ! DETERMINAR EN QUE SEDE UNIFRANZ SE HALLA EL USUARIO
const determinarSedeActual = async (posicion) => {
    let latitud = posicion.coords.latitude;
    let longitud = posicion.coords.longitude;

    //* establecer la ubicacion del usuario
    var pt = turf.point([latitud, longitud].reverse());

    let ubicacionesPosibles = [
        //0
        {
            sede: "LA PAZ",
            ubicacionDentro: turf.booleanPointInPolygon(pt, laPaz),
        },
        //1
        {
            sede: "EL ALTO",
            ubicacionDentro: turf.booleanPointInPolygon(pt, elAlto),
        },
    ];

    let ubicacionActual = null;

    for (let i = 0; i < ubicacionesPosibles.length; i++) {
        if (ubicacionesPosibles[i].ubicacionDentro) {
            ubicacionActual = ubicacionesPosibles[i];
            break;
        }
    }

    await delay(3000);

    return ubicacionActual != null ? ubicacionActual : false;
};

// ! UTILIDADES
function delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

const ocultarSteps = () => {
    var steps = $(".steps-inner");
    steps.hide();
};
