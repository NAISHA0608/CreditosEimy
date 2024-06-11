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