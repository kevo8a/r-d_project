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
    fetch('/r&d/php/get_clients.php') // Verifica la URL
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const select = document.getElementById('cliente');
            select.innerHTML = ''; // Limpia las opciones anteriores
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

function calificar(id) {
    // Muestra una alerta personalizada con opciones
    const alertDiv = document.createElement('div');
    alertDiv.classList.add('alert', 'alert-info');
    alertDiv.innerHTML = `
        <div class="text-center">
            <p>¿Cómo deseas calificar?</p>
            <button class="btn btn-success" onclick="handleCalificacion('Aprobar', ${id})">Aprobar</button>
            <button class="btn btn-warning" onclick="handleCalificacion('Corregir', ${id})">Corregir</button>
            <button class="btn btn-danger" onclick="handleCalificacion('Rechazar', ${id})">Rechazar</button>
        </div>
    `;
    document.body.appendChild(alertDiv);
}

function handleCalificacion(decision, id) {
    // Aquí puedes manejar la calificación, por ejemplo, enviar una solicitud AJAX al servidor
    alert(`Has elegido: ${decision} para el ID: ${id}`);
    
    // Puedes eliminar el alertDiv después de hacer clic
    const alertDiv = document.querySelector('.alert');
    if (alertDiv) alertDiv.remove();
}
