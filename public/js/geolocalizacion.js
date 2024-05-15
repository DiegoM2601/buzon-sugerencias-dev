const txtConteo = document.getElementById("conteo");

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
const geoSuccess = (posicion) => {
    $("#geo-error").hide();
    $("#step-0").show();

    //TODO: Agarrar la ip ni bien se ejecute esta función, almacenarla en la base de datos quizás y comparar
    //TODO: Ejecutar la función WATCHID cada cierto intervalo?????????
    //TODO: Usar un gif de cargando en lo que se ejecuta esta función porque aveces la pantalla queda en blanco mucho tiempo
    //TODO: Por alguna razon en firefox movil detecta que el permiso de ubicación se desactiva a cada rato, esto no pasa en Opera, tampoco en Chrome
    /**
     * Cuando una aplicación está utilizando el GPS, recién el ícono aparece en el pantel de notificaciones. Eso pasa con Opera, sin embargo, con Firefox el ícono nunca aparece.
     */

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

function conteoRegresivo() {
    var segundos = 5;

    var conteo = setInterval(function () {
        segundos--;
        if (segundos < 0) {
            clearInterval(conteo);
            location.reload();
        } else {
            txtConteo.textContent = segundos;
        }
    }, 1000);
}
