<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener ID del registro a editar
$id = $_GET['id'];

// Obtener datos del registro
$sql = "SELECT * FROM form2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data = json_decode($row['table_content'], true); // Decodificar JSON a un array

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de Cotización</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../structure/navbar.php'; ?>
                <div class="container-fluid">
                    <div class="container mt-5">
                        <h1 class="text-center mb-4">Editar Formulario de Cotización</h1>
                        <form id="form-estructure" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="row">
                                    <!-- Sección de campos -->
                                    <div class="col-md-3 mb-3">
                                        <label for="solicitante" class="form-label">Solicitante</label>
                                        <input type="text" class="form-control" id="solicitante" name="solicitante"
                                            value="<?php echo htmlspecialchars($row['name_user'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="project_name" class="form-label">Nombre del
                                            Proyecto/Producto</label>
                                        <input type="text" class="form-control" id="project_name" name="project_name"
                                            value="<?php echo htmlspecialchars($row['project_name'] ?? ''); ?>"
                                            disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="site" class="form-label">Site</label>
                                        <input type="text" class="form-control" id="site" name="site"
                                            value="<?php echo htmlspecialchars($row['site_user'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="folio" class="form-label">Folio</label>
                                        <input type="text" class="form-control" id="folio" name="folio"
                                            value="<?php echo htmlspecialchars($row['id_form2'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="id_user" class="form-label">ID del Usuario</label>
                                        <input type="text" class="form-control" id="id_user" name="id_user"
                                            value="<?php echo htmlspecialchars($row['id_user'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="qualified_by" class="form-label">Calificado por</label>
                                        <input type="text" class="form-control" id="qualified_by" name="qualified_by"
                                            value="<?php echo htmlspecialchars($row['qualified_by'] ?? ''); ?>"
                                            disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="created_at" class="form-label">Fecha de creación</label>
                                        <input type="text" class="form-control" id="created_at" name="created_at"
                                            value="<?php echo htmlspecialchars($row['created_at'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="completed_at" class="form-label">Fecha de finalización</label>
                                        <input type="text" class="form-control" id="completed_at" name="completed_at"
                                            value="<?php echo htmlspecialchars($row['completed_at'] ?? ''); ?>"
                                            disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="client" class="form-label">Cliente</label>
                                        <input type="text" class="form-control" id="client" name="client"
                                            value="<?php echo htmlspecialchars($row['name_client'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="status" class="form-label">Estatus</label>
                                        <input type="text" class="form-control" id="status" name="status"
                                            value="<?php echo htmlspecialchars($row['status_form2'] ?? ''); ?>"
                                            disabled>
                                    </div>
                                    <table class="table table-bordered" id="materialTable">
                                        <thead class="table-warning">
                                            <tr>
                                                <th>MTL</th>
                                                <th>Material</th>
                                                <th>Calibre</th>
                                                <th>Peso</th>
                                                <th>Sólidos</th>
                                                <th>Acciones</th> <!-- Columna para los botones -->
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <?php
                                            $counter = 1;
                                            foreach ($data as $item) {
                                                echo '<tr>';
                                                echo '<td><input type="text" name="MTL' . $counter . '" class="form-control" value="' . htmlspecialchars($item["MTL"]) . '" required></td>';
                                                echo '<td><input type="text" name="Material' . $counter . '" class="form-control" value="' . htmlspecialchars($item["Material"]) . '" required></td>';
                                                echo '<td><input type="text" name="Calibre' . $counter . '" class="form-control" value="' . htmlspecialchars($item["Calibre"]) . '" required onchange="calculateTotal()"></td>';
                                                echo '<td><input type="text" name="Peso' . $counter . '" class="form-control" value="' . htmlspecialchars($item["Peso"]) . '" required onchange="calculateTotal()"></td>';
                                                echo '<td><input type="text" name="Solidos' . $counter . '" class="form-control" value="' . htmlspecialchars($item["Solidos"]) . '" required onchange="calculateTotal()"></td>';
                                                echo '<td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Eliminar</button></td>';
                                                echo '</tr>';
                                                $counter++;
                                            }
                                            ?>
                                        </tbody>
                                        <!-- Fila de Totales -->
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                            <td><input type="text" id="totalCalibre" class="form-control" disabled></td>
                                            <td><input type="text" id="totalPeso" class="form-control" disabled></td>
                                            <td></td>
                                        </tr>
                                        <!-- Botón para agregar fila dentro de la tabla -->

                                    </table>
                                    <!-- Botón para agregar fila fuera de la tabla -->
                                    <tr>
                                        <td colspan="">
                                            <button type="button" class="btn btn-success btn-block"
                                                onclick="addRow()">Agregar Fila</button>
                                        </td>
                                    </tr>
                                    <!-- Campos adicionales de procesos -->
                                    <?php for ($step = 1; $step <= 6; $step++): ?>
                                    <div class="col-md-12 mb-3">
                                        <label for="proceso<?php echo $step; ?>" class="form-label">Paso
                                            <?php echo $step; ?></label>
                                        <input type="text" class="form-control" id="proceso<?php echo $step; ?>"
                                            name="proceso<?php echo $step; ?>"
                                            value="<?php echo htmlspecialchars($row['step_' . $step] ?? ''); ?>">
                                    </div>
                                    <?php endfor; ?>
                                    <!-- Comentarios -->
                                    <div class="col-md-12">
                                            <label for="comentarios" class="form-label">Comentarios</label>
                                            <input type="text" class="form-control" id="comentarios" name="comentarios"
                                                value="<?php echo $row ? htmlspecialchars($row['comments']) : ''; 
                                                ?>" disabled>
                                    </div>
                                    <!-- Campos del formulario de envío -->
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="window.history.back()">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    let counter = <?php echo $counter; ?>;

    function addRow() {
        const tableBody = document.getElementById('tableBody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="MTL${counter}" class="form-control" required></td>
            <td><input type="text" name="Material${counter}" class="form-control" required></td>
            <td><input type="text" name="Calibre${counter}" class="form-control" required onchange="calculateTotal()"></td>
            <td><input type="text" name="Peso${counter}" class="form-control" required onchange="calculateTotal()"></td>
            <td><input type="text" name="Solidos${counter}" class="form-control" required onchange="calculateTotal()"></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Eliminar</button></td>
        `;
        tableBody.appendChild(row);
        counter++;
    }

    function removeRow(button) {
        button.closest('tr').remove();
        calculateTotal(); // Recalcular totales cuando se elimina una fila
    }


    function calculateTotal() {
        let totalCalibre = 0;
        let totalPeso = 0;

        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const caliber = parseFloat(row.querySelector('input[name*="Calibre"]').value) || 0;
            const weight = parseFloat(row.querySelector('input[name*="Peso"]').value) || 0;

            totalCalibre += caliber;
            totalPeso += weight;
        });

        document.getElementById('totalCalibre').value = totalCalibre.toFixed(2);
        document.getElementById('totalPeso').value = totalPeso.toFixed(2);
    }

    window.onload = function() {
        calculateTotal();
    };

$(document).ready(function() {
    $('#form-estructure').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío normal del formulario

        // Crear un objeto FormData con los datos del formulario
        var formData = new FormData(this);

        // Enviar la solicitud AJAX
        $.ajax({
            url: '../../php/update_form2.php?id=' + <?php echo $_GET['id']; ?>, // Ajusta la URL al archivo PHP correcto
            type: 'POST',
            data: formData,
            processData: false,  // No procesar los datos
            contentType: false,  // No establecer el tipo de contenido (esto es importante para el FormData)
            success: function(response) {
                // Si la respuesta es exitosa, redirigir
                alert('Registro actualizado correctamente.');
                window.location.href = '/r&d/html/index.php'; // Redirigir después de actualizar
            },
            error: function(xhr, status, error) {
                // Manejar errores
                alert("Hubo un error en la comunicación con el servidor.");
            }
        });
    });
});
</script>




</body>

</html>