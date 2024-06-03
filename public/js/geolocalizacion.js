const laPaz = turf.polygon([sedeLaPaz.features[0].geometry.coordinates[0]]);
const laPaz2 = turf.polygon([sedeLaPaz2.features[0].geometry.coordinates[0]]);
const elAlto = turf.polygon([sedeElAlto.features[0].geometry.coordinates[0]]);
const cochabamba = turf.polygon([
    sedeCochabamba.features[0].geometry.coordinates[0],
]);
const santaCruz = turf.polygon([
    sedeSantaCruz.features[0].geometry.coordinates[0],
]);

function activarGeolocalizacion() {
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };

    ocultarSteps();
    $("#geo-load").show();

    // * capturar por una única vez la ubicación actual del usuario
    var watchID = navigator.geolocation.getCurrentPosition(
        geoSuccess,
        geoError,
        options
    );
}

// ! GEOLOCALIZACION
const geoSuccess = async (posicion) => {
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

        // almacenar ubicacion del usuario
        setCookie("sedeUnifranz", ubicacion.sede);

        ocultarSteps();
        $("#step-1").show();
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
            sede: "LA PAZ",
            ubicacionDentro: turf.booleanPointInPolygon(pt, laPaz2),
        },
        //2
        {
            sede: "EL ALTO",
            ubicacionDentro: turf.booleanPointInPolygon(pt, elAlto),
        },
        //3
        {
            sede: "COCHABAMBA",
            ubicacionDentro: turf.booleanPointInPolygon(pt, cochabamba),
        },
        //4
        {
            sede: "SANTA CRUZ",
            ubicacionDentro: turf.booleanPointInPolygon(pt, santaCruz),
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

function setCookie(name, value) {
    var date = new Date();

    //vigencia de una hora
    date.setTime(date.getTime() + 1 * 60 * 60 * 1000);
    var expires = "; expires=" + date.toUTCString();

    document.cookie =
        name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
}

function deleteCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999; path=/";
}
