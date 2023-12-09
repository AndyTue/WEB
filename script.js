
let imgProducto = document.getElementById("imgProducto");
let miniaturas = document.querySelectorAll(".miniaturas img");

function setMini(pos){

    if(pos=='0'){
        imgProducto.style.transform = "rotateZ(0deg)";

    }
    if(pos=='1'){
        imgProducto.style.transform = "rotateZ(35deg)";

    }
    if(pos=='2'){
        imgProducto.style.transform = "rotateZ(-55deg) scale(0.75)";

    }

    miniaturas[0].style.backgroundColor = "#fff1d9";
    miniaturas[1].style.backgroundColor = "#fff1d9";
    miniaturas[2].style.backgroundColor = "#fff1d9";
    miniaturas[pos].style.backgroundColor = "#fdc10e";
}

let sizes = document.querySelectorAll(".info-detalle button");

function setSize(pos){
    sizes[0].style.backgroundColor = "#fff1d9";
    sizes[1].style.backgroundColor = "#fff1d9";
    sizes[2].style.backgroundColor = "#fff1d9";
    sizes[pos].style.backgroundColor = "#fdc10e";
}

//MENU RESPONSIVE
let menu_responsive_visible = false;
let nav_responsive = document.getElementById("nav-responsive");
let nav = document.getElementById("nav");
let close_responsive = document.getElementById("close-responsive");

nav_responsive.onclick = function(){
    if(menu_responsive_visible==false){
        nav.className = "menu-responsive";
        menu_responsive_visible = true;
    }
}
close_responsive.onclick = function(){
    if(menu_responsive_visible==true){
        nav.className = "";
        menu_responsive_visible = false;
    }
}

function validarFormulario() {
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const pais = document.getElementById('pais').value;
    const mensaje = document.getElementById('mensaje').value;

    if (!nombre || !correo || pais === '' || !mensaje) {
        alert('Por favor, complete todos los campos del formulario.');
        return false;
    }
    return true;
}

// Agrega este código en tu archivo script.js
document.addEventListener("DOMContentLoaded", function () {
    const productForm = document.getElementById("product-form");

    productForm.addEventListener("submit", function (event) {
        event.preventDefault();

        // Aquí puedes agregar lógica para enviar los datos al servidor
        // Puedes usar fetch() o cualquier otra técnica para enviar datos al backend
        // Ejemplo:
        const formData = new FormData(productForm);

        // Agrega aquí la lógica para enviar formData al servidor

        // Después de enviar los datos, puedes limpiar el formulario si es necesario
        productForm.reset();
    });
});

// Almacenar el token en sessionStorage al iniciar sesión
function guardarToken(token) {
    sessionStorage.setItem('token', token);
}

// Obtener el token almacenado en sessionStorage
function obtenerToken() {
    return sessionStorage.getItem('token');
}

// Eliminar el token almacenado en sessionStorage al cerrar sesión
function eliminarToken() {
    sessionStorage.removeItem('token');
}


document.addEventListener('DOMContentLoaded', function() {
    const botonSesion = document.getElementById('botonSesion');

    // Verificar si hay un token almacenado
    if (sessionStorage.getItem('token')) {
        botonSesion.textContent = 'Cerrar Sesión'; // Cambiar texto del botón
        // Asignar una función al botón para cerrar sesión
        botonSesion.addEventListener('click', function() {
            // Eliminar el token al hacer clic en "Cerrar Sesión"
            sessionStorage.removeItem('token');
            // Luego, redirigir o ejecutar otras acciones necesarias
            // window.location.href = 'tuPaginaDeInicio.html';
        });
    } else {
        // Si no hay token, asignar función para iniciar sesión
        botonSesion.addEventListener('click', function() {
            // Aquí puedes escribir la lógica para iniciar sesión y guardar el token
            // guardarToken('tuTokenAquí');
            sessionStorage.setItem('token', 'tuTokenAquí');
            botonSesion.textContent = 'Cerrar Sesión'; // Cambiar texto del botón
        });
    }
});