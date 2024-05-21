const laPaz = turf.polygon([sedeLaPaz.features[0].geometry.coordinates[0]]);
const elAlto = turf.polygon([sedeElAlto.features[0].geometry.coordinates[0]]);

// const txtConteo = document.getElementById("conteo");
// const txtConteo = document.querySelector(".conteo");

function activarGeolocalizacion(mensaje) {
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };

    // Solicitar la ubicación
    var watchID = navigator.geolocation.watchPosition(
        geoSuccess,
        geoError,
        options
    );
}

// ! GEOLOCALIZACION
const geoSuccess = async (posicion) => {
    $("#geo-error").hide();
    // $("#step-0").show();
    $("#geo-load").show();

    //TODO: Agarrar la ip ni bien se ejecute esta función, almacenarla en la base de datos quizás y comparar
    //TODO: Ejecutar la función WATCHID cada cierto intervalo?????????
    //TODO: Usar un gif de cargando en lo que se ejecuta esta función porque aveces la pantalla queda en blanco mucho tiempo
    //TODO: Por alguna razon en firefox movil detecta que el permiso de ubicación se desactiva a cada rato, esto no pasa en Opera, tampoco en Chrome
    /**
     * Cuando una aplicación está utilizando el GPS, recién el ícono aparece en el pantel de notificaciones. Eso pasa con Opera, sin embargo, con Firefox el ícono nunca aparece.
     */

    let ubicacion = await determinarSedeActual(posicion);
    if (ubicacion) {
        document.getElementById("geo-sede-detectada").innerText =
            "ESTÁS EN LA SEDE " + ubicacion.sede;

        document.getElementById(
            "geo-animacion"
        ).innerHTML = `<img src="/gifs/check-list.gif" width="200px">`;

        document.getElementById("geo-load-msj").innerText = "";

        await delay(3000);

        $("#geo-load").hide();
        $("#step-0").show();
    } else {
        document.getElementById("geo-sede-detectada").innerText =
            "NINGUNA SEDE DETECTADA";
        document.getElementById("geo-load-msj").innerText = "";
        document.getElementById(
            "geo-error-msj"
        ).innerHTML = `LO SENTIMOS, DEBES HALLARTE AL INTERIOR DE UNA SEDE PARA ACCEDER AL FORMULARIO, INTÉNTALO NUEVAMENTE EN <b class = "conteo">5</b>`;

        await delay(3000);

        $("#geo-load").hide();
        $("#geo-error").show();
        conteoRegresivo();
    }

    console.log("ejemplo");
};
const geoError = (error) => {
    $("#geo-0").hide();
    $("#geo-error").show();
    conteoRegresivo();

    //comprobar si el usuario denegó el permiso en mitad del proceso
    if (error.PERMISSION_DENIED) {
        //TODO: Ocultar TODAS las vistas mediante un bucle o mediante querySelector
        $("#geo-0").hide();
        $("#geo-error").show();
        conteoRegresivo();
    }
};

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

function conteoRegresivo() {
    var segundos = 5;

    let txtConteo = document.querySelector(".conteo");

    var conteo = setInterval(function () {
        segundos--;
        if (segundos < 0) {
            clearInterval(conteo);
            location.reload();
        } else {
            txtConteo.textContent = segundos;
            // document.querySelector(".conteo").textContent = segundos;
        }
    }, 1000);
}

// UTILIDADES
function delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}
