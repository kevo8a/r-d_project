<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];

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
}

mysqli_close($conn);
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
                        <h1 class="text-center mb-4"><?php echo $id_formulario ? 'Editar' : 'Crear'; ?> Formulario de Cotización</h1>
                        <form id="form-estructure" method="POST" method="POST" enctype="multipart/form-data"> 
                            <?php if ($id_formulario): ?>
                                <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">
                            <?php endif; ?>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="solicitadoPor" class="form-label">Solicitado por</label>
                                    <input type="text" class="form-control" id="solicitadoPor" name="solicitadoPor" value="<?php echo htmlspecialchars($form_data['solicitadoPor'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo htmlspecialchars($form_data['cliente'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nombreProyecto" class="form-label">Nombre del proyecto/Producto</label>
                                    <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto" value="<?php echo htmlspecialchars($form_data['nombreProyecto'] ?? ''); ?>">
                                </div>

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
                                        <!-- Filas por defecto -->
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <tr>
                                                <td><input type="text" class="form-control" name="mtl[]"></td>
                                                <td><input type="text" class="form-control" name="material[]"></td>
                                                <td><input type="number" class="form-control calibre" name="calibre[]" oninput="calculateTotals()"></td>
                                                <td><input type="number" class="form-control peso" name="peso[]" oninput="calculateTotals()"></td>
                                                <td><input type="number" class="form-control" name="solidos[]"></td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end">Total</td>
                                            <td><input type="number" class="form-control" id="totalCalibre" disabled value="0.00"></td>
                                            <td><input type="number" class="form-control" id="totalPeso" disabled value="0.00"></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">Añadir fila</button>

                                <!-- Sección de procesos -->
                                <?php for ($step = 1; $step <= 6; $step++): ?>
                                    <div class="mb-3">
                                        <label for="proceso<?php echo $step; ?>" class="form-label">Paso <?php echo $step; ?></label>
                                        <input type="text" class="form-control" id="proceso<?php echo $step; ?>" name="proceso<?php echo $step; ?>" value="<?php echo htmlspecialchars($form_data['proceso' . $step] ?? ''); ?>">
                                    </div>
                                <?php endfor; ?>

                                <button type="submit" class="btn btn-primary">Enviar</button>
                            <div class="row">
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
</body>
</html>
