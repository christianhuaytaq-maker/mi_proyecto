document.addEventListener("DOMContentLoaded", function () {

    const formulario = document.querySelector(".formulario");

    if (formulario) {

        formulario.addEventListener("submit", function () {

            const boton = formulario.querySelector(".boton-enviar");

            boton.textContent = "Enviando...";

        });

    }

});