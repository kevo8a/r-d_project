<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];
$table_content = isset($form_data['table_content']) ? json_decode($form_data['table_content'], true) : [];

// Si hay un ID, consultar los datos del formulario por su ID
if ($id_formulario) {
    $sql = "SELECT * FROM form2 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_formulario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows === 0) {
        die('Formulario no encontrado.');
    }
    $form_data = mysqli_fetch_assoc($result);
    // Decodificar table_content
    $table_content = isset($form_data['table_content']) ? json_decode($form_data['table_content'], true) : [];
} else {
    die('No se proporcionó un ID válido para editar el formulario.');
}
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
                            <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">
                            <div class="row">
                                <!-- Sección de campos -->
                                <div class="col-md-6 mb-3">
                                    <label for="solicitante" class="form-label">Solicitante</label>
                                    <input type="text" class="form-control" id="solicitante" name="solicitante" value="<?php echo htmlspecialchars($form_data['name_user'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="site" class="form-label">Site</label>
                                    <input type="text" class="form-control" id="site" name="site" value="<?php echo htmlspecialchars($form_data['site_user'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo htmlspecialchars($form_data['id_user'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="qualified_by" class="form-label">Calificado por</label>
                                    <input type="text" class="form-control" id="qualified_by" name="qualified_by" value="<?php echo htmlspecialchars($form_data['qualified_by'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="created_at" class="form-label">Fecha de creación</label>
                                    <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo htmlspecialchars($form_data['created_at'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="completed_at" class="form-label">Fecha de finalización</label>
                                    <input type="text" class="form-control" id="completed_at" name="completed_at" value="<?php echo htmlspecialchars($form_data['completed_at'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="client" name="client" value="<?php echo htmlspecialchars($form_data['name_client'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($form_data['status_form2'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="project_name" class="form-label">Nombre del Proyecto/Producto</label>
                                    <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo htmlspecialchars($form_data['project_name'] ?? ''); ?>">
                                </div>
                            </div>

                            <!-- Tabla de materiales -->
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered" id="materialTable">
                                    <thead class="table-warning">
                                        <tr>
                                            <th>MTL</th>
                                            <th>Material</th>
                                            <th>Calibre Micras (μ)</th>
                                            <th>Peso por m² (g/m²)</th>
                                            <th>% Sólidos</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        $mtl = isset($table_content['mtl' . ($i + 1)]) ? $table_content['mtl' . ($i + 1)] : '';
                                        $material = isset($table_content['material' . ($i + 1)]) ? $table_content['material' . ($i + 1)] : '';
                                        $caliber = isset($table_content['caliber' . ($i + 1)]) ? $table_content['caliber' . ($i + 1)] : '';
                                        $weight = isset($table_content['weight' . ($i + 1)]) ? $table_content['weight' . ($i + 1)] : '';
                                        $solid = isset($table_content['solid' . ($i + 1)]) ? $table_content['solid' . ($i + 1)] : '';
                                        echo "<tr>";
                                        echo "<td><input type='text' name='mtl" . ($i + 1) . "' class='form-control' value='" . htmlspecialchars($mtl) . "'></td>";
                                        echo "<td><input type='text' name='material" . ($i + 1) . "' class='form-control' value='" . htmlspecialchars($material) . "'></td>";
                                        echo "<td><input type='number' name='caliber" . ($i + 1) . "' class='form-control' value='" . htmlspecialchars($caliber) . "'></td>";
                                        echo "<td><input type='number' name='weight" . ($i + 1) . "' class='form-control' value='" . htmlspecialchars($weight) . "'></td>";
                                        echo "<td><input type='number' name='solid" . ($i + 1) . "' class='form-control' value='" . htmlspecialchars($solid) . "'></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end">Total</td>
                                            <td><input type="number" class="form-control" id="totalCalibre" disabled value="0.00"></td>
                                            <td><input type="number" class="form-control" id="totalPeso" disabled value="0.00"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">Añadir fila</button>

                            <!-- Campos adicionales de procesos -->
                            <?php for ($step = 1; $step <= 6; $step++): ?>
                                <div class="col-md-6 mb-3">
                                    <label for="proceso<?php echo $step; ?>" class="form-label">Paso <?php echo $step; ?></label>
                                    <input type="text" class="form-control" id="proceso<?php echo $step; ?>" name="proceso<?php echo $step; ?>" value="<?php echo htmlspecialchars($form_data['proceso' . $step] ?? ''); ?>">
                                </div>
                            <?php endfor; ?>

                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script>
    // Función para agregar una nueva fila a la tabla
    function addRow() {
        const tableBody = document.getElementById('tableBody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="mtl" class="form-control"></td>
            <td><input type="text" name="material" class="form-control"></td>
            <td><input type="number" name="caliber" class="form-control" oninput="calculateTotal()"></td>
            <td><input type="number" name="weight" class="form-control" oninput="calculateTotal()"></td>
            <td><input type="number" name="solid" class="form-control" oninput="calculateTotal()"></td>
        `;
        tableBody.appendChild(row);
    }

    // Función para calcular los totales de Calibre, Peso y % Sólidos
    function calculateTotal() {
        let totalCalibre = 0;
        let totalPeso = 0;
        let totalSolid = 0;

        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const caliber = parseFloat(row.querySelector('input[name*="caliber"]').value) || 0;
            const weight = parseFloat(row.querySelector('input[name*="weight"]').value) || 0;
            const solid = parseFloat(row.querySelector('input[name*="solid"]').value) || 0;

            totalCalibre += caliber;
            totalPeso += weight;
            totalSolid += solid;
        });

        // Mostrar los totales en los campos de pie de tabla
        document.getElementById('totalCalibre').value = totalCalibre.toFixed(2);
        document.getElementById('totalPeso').value = totalPeso.toFixed(2);
        document.getElementById('totalSolid').value = totalSolid.toFixed(2);
    }
    
    // Se añade un evento a los campos de la tabla para recalcular los totales al modificar cualquier valor
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll('input[name*="caliber"], input[name*="weight"], input[name*="solid"]');
        inputs.forEach(input => {
            input.addEventListener("input", calculateTotal);
        });
    });
</script>

</body>
</html>
