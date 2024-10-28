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

document.addEventListener("DOMContentLoaded", function () {
    const checkDisenoContinuo = document.getElementById("continuous_check");
    const fotodistancias = document.getElementById("fotodistancias");
    const toleranciaFotodistancias = document.getElementById("tolerancia_fotodistancias");

    // Función para alternar la propiedad 'disabled' de los campos de fotodistancias
    function toggleFotodistancias() {
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

    // Llama a la función toggleFotodistancias al cargar la página para establecer el estado inicial
    toggleFotodistancias();

    // Añadir el evento de cambio al checkbox
    checkDisenoContinuo.addEventListener("change", toggleFotodistancias);
});// Función para cargar los clientes
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
function toggleDimensionesBolsa() {
    const esBolsa = $("#es_bolsa").is(":checked"); // Verifica si el checkbox está marcado

    $(".bolsa_fields").each(function() {
        const $bolsaField = $(this);
        const $inputFields = $bolsaField.find("input");

        if (esBolsa) { // Si el checkbox está marcado
            $bolsaField.show(); // Muestra los campos
            $inputFields.each(function() {
                $(this).attr("required", "required"); // Añadir 'required' nuevamente
            });
        } else { // Si el checkbox no está marcado
            $bolsaField.hide(); // Oculta los campos
            $inputFields.each(function() {
                $(this).val("").removeAttr("required"); // Limpiar valores y quitar 'required'
            });
        }
    });
}

// Inicializa el estado de los campos al cargar la página
$(document).ready(function() {
    toggleDimensionesBolsa(); // Inicializa el estado de dimensiones de bolsa
    $("#es_bolsa").change(toggleDimensionesBolsa); // Llama a la función cuando cambia el estado del checkbox
});
