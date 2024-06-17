document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("miFormulario");

    formulario.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
        }
    });
});

function validateForm() {
    const name = document.getElementById("name").value;
    const weight = document.getElementById("weight").value;
    const nameRegex = /^[A-Za-z\s]+$/;
    const weightRegex = /^[0-9]+$/;

    if (!nameRegex.test(name)) {
        alert("El nombre del electrodoméstico debe contener solo letras.");
        return false;
    }

    if (!weightRegex.test(weight)) {
        alert("El peso del producto debe contener solo números.");
        return false;
    }

    return true;
}
