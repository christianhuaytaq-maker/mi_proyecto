document.addEventListener("DOMContentLoaded", function () {

    const formularioPedido =
        document.querySelector(".formulario");

    if (formularioPedido) {

        formularioPedido.addEventListener("submit", function () {

            const boton =
                formularioPedido.querySelector(".boton-enviar");

            if (boton) {
                boton.textContent = "Enviando...";
            }

        });

    }

});


function mostrarFormularioPlato() {

    const formulario =
        document.getElementById("formulario-plato");

    if (formulario) {

        formulario.style.display = "block";

        formulario.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });

    }

}


function ocultarFormularioPlato() {

    const formulario =
        document.getElementById("formulario-plato");

    if (formulario) {

        formulario.style.display = "none";

    }

}