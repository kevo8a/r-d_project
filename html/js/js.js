function toggleNumeroColores() {
    const sistemaImpresion = document.getElementById("sistema_impresion");
    const numeroColores = document.getElementById("numero_colores");
    
    if (sistemaImpresion.value === "Sin impresión") {
        numeroColores.disabled = true;
        numeroColores.value = "";  // Vacía el campo número de colores
    } else {
        numeroColores.disabled = false;
    }
}

function toggleFotodistancias() {
    const checkDisenoContinuo = document.getElementById("check_diseno_continuo");
    const fotodistancias = document.getElementById("fotodistancias");
    const toleranciaFotodistancias = document.getElementById("tolerancia_fotodistancias");

    if (checkDisenoContinuo.checked) {
        fotodistancias.disabled = true;
        fotodistancias.value = ""; // Borrar el valor
        toleranciaFotodistancias.disabled = true;
        toleranciaFotodistancias.value = ""; // Borrar el valor
    } else {
        fotodistancias.disabled = false;
        toleranciaFotodistancias.disabled = false;
    }
}

function toggleDimensionesBolsa() {
    const esBolsa = document.getElementById("es_bolsa").value;
    const bolsaFields = document.getElementsByClassName("bolsa_fields");

    for (let i = 0; i < bolsaFields.length; i++) {
        const inputFields = bolsaFields[i].getElementsByTagName("input");

        if (esBolsa === "No") {
            bolsaFields[i].style.display = "none";

            // Limpiar los valores de los campos input y eliminar el atributo 'required'
            for (let j = 0; j < inputFields.length; j++) {
                inputFields[j].value = "";
                inputFields[j].removeAttribute("required");
            }
        } else {
            bolsaFields[i].style.display = "block";

            // Añadir el atributo 'required' nuevamente
            for (let j = 0; j < inputFields.length; j++) {
                inputFields[j].setAttribute("required", "required");
            }
        }
    }
}

// Inicializa el estado del campo Código de Sostenibilidad
document.addEventListener("DOMContentLoaded", function() {
    const checkSostenibilidad = document.getElementById("check_sostenibilidad");
    const codigoSostenibilidad = document.getElementById("codigo_sostenibilidad");

    toggleCodigoSostenibilidad();

    checkSostenibilidad.addEventListener("change", toggleCodigoSostenibilidad);

    function toggleCodigoSostenibilidad() {
        if (checkSostenibilidad.checked) {
            codigoSostenibilidad.disabled = false;
        } else {
            codigoSostenibilidad.disabled = true;
            codigoSostenibilidad.value = "";  // Elimina el contenido del campo
        }
    }
});

// Función para cargar los clientes
function loadClients() {
    fetch('get_clients.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('cliente');
            data.forEach(client => {
                const option = document.createElement('option');
                option.value = client;
                option.textContent = client;
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los clientes:', error));
}

// Cargar los clientes al cargar la página
document.addEventListener('DOMContentLoaded', loadClients);

// Inicializa el estado del campo Número de Colores al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    const sistemaImpresion = document.getElementById("sistema_impresion");
    const numeroColores = document.getElementById("numero_colores");

    toggleNumeroColores(); // Llama a la función para configurar el estado del campo

    sistemaImpresion.addEventListener("change", toggleNumeroColores);
});
