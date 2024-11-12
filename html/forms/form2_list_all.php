<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Verifica si el usuario tiene rol 1 o 2
if ($role != 1 && $role != 2) {
    header("Location: /path/to/r&d/html/login.php");
    exit();
}

// Consulta para obtener las cotizaciones
$sql = "SELECT id, id_form2, id_user, name_user, name_client, status_form2, project_name, qualified_by, created_at, completed_at FROM form2";
$result = $conn->query($sql);
?><

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Formulario Cotización</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
    <style>
        .modal {
            display: none;
        }
        .modal.active {
            display: block;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../structure/navbar.php'; ?>

                <div class="container mt-5">
                    <h1 class="text-center">Formularios de Cotización</h1>
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Proyecto</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Estatus</th>
                                <th>Calificado por</th>
                                <th>Fechas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $status_class = '';
                                switch ($row['status_form2']) {
                                    case 'Complete':
                                        $status_class = 'bg-success text-white';
                                        break;
                                    case 'Rechazado':
                                        $status_class = 'bg-danger text-white';
                                        break;
                                    case 'En Proceso':
                                        $status_class = 'bg-primary text-white';
                                        break;
                                    case 'Corregir':
                                        $status_class = 'bg-warning text-dark';
                                        break;
                                    case 'Nuevo':
                                        $status_class = 'bg-info text-white'; 
                                        break;
                                    default:
                                        $status_class = 'bg-secondary text-white';
                                        break;
                                }

                                echo "<tr>";
                                echo "<td>" . $row['id_form2'] . "</td>"; // Usando el ID aquí
                                echo "<td>" . $row['project_name'] . "</td>";
                                echo "<td>" . $row['name_client'] . "</td>";
                                echo "<td>" . $row['name_user'] . ' (' . $row['id_user'] . ')' . "</td>";
                                echo "<td class='$status_class'>" . $row['status_form2'] . "</td>";
                                echo "<td>" . $row['qualified_by'] . "</td>";
                                echo "<td>" . $row['created_at'] . "<br>" . $row['completed_at'] . "</td>";
                                echo "<td>
                                        <a href='/r&d/html/forms/form2_show.php?id=" . $row['id'] . "' class='btn btn-outline-primary btn-sm'>Ver completo</a>";

                                // Mostrar el botón de "Calificar" solo si el estado no es "Complete"
                                if ($row['status_form2'] !== 'Complete') {
                                    echo "<button class='btn btn-outline-secondary btn-sm ml-2' onclick='calificar(" . $row['id'] . ")'>Calificar</button>";
                                }

                                // Mostrar el botón de Editar solo si el estatus es "Corregir" o "Nuevo"
                                if ($row['status_form2'] === 'Corregir' || $row['status_form2'] === 'Nuevo') {
                                    // Cambiar el texto del botón según el estado
                                    $button_text = ($row['status_form2'] === 'Nuevo') ? 'Completar' : 'Editar';
                                    echo "<a href='/r&d/html/forms/form2_create_edit.php?id=" . $row['id'] . "' class='btn btn-outline-warning btn-sm ml-2'>$button_text</a>";
                                }

                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No hay formularios creados</td></tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>

    <script>
    function calificar(id) {
        closeModal(); // Cierra cualquier modal abierto

        const modalHtml = `
            <div class="modal active" id="calificarModal-${id}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Calificar</h5>
                            <button type="button" class="btn-close" onclick="closeModal(${id})"></button>
                        </div>
                        <div class="modal-body">
                            <p>Seleccione una opción:</p>
                            <button class="btn btn-success" onclick="submitCalificacion('Aprobar', ${id})">Aprobar</button>
                            <button class="btn btn-danger" onclick="submitCalificacion('Rechazar', ${id})">Rechazar</button>
                        </div>
                    </div>
                </div>
            </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }

    function closeModal(id) {
        const modal = document.getElementById(`calificarModal-${id}`);
        if (modal) {
            modal.remove();
        }
    }

    function submitCalificacion(opcion, id) {
    // Verificar los datos antes de enviarlos
    console.log('Enviando datos:', { opcion, id });

    // Enviar solicitud AJAX para aprobar o rechazar
        $.ajax({
        url: '../../php/aprobar_form2.php',  // Ruta del archivo PHP
        type: 'POST',  // Usamos el método POST
        data: {
            id: id,  // Pasamos el ID del formulario
            calificacion: opcion  // Agregamos el tipo de calificación (Aprobar/Rechazar)
        },
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            alert(jsonResponse.message);  // Mostrar el mensaje de la respuesta
            closeModal(id);  // Cerrar el modal después de recibir la respuesta
            
            if (jsonResponse.status === "success") {
                location.reload();  // Recargar la página si el estado es "success"
            }
        },
        error: function() {
            alert("Hubo un error en la solicitud.");
        }
    });

}

</script>

</body>

</html>
