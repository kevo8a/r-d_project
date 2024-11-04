<?php
include '../../php/db_connection.php';
include '../../php/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../structure/navbar.php'; ?>

                <!-- Contenido -->   
                <div class="container-fluid">
                <div class="container mt-5">
        <form>
            <!-- Encabezado -->
            <div class="mb-3">
                <label for="solicitadoPor" class="form-label">Solicitado por</label>
                <input type="text" class="form-control" id="solicitadoPor">
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="cliente">
            </div>
            <div class="mb-3">
                <label for="nombreProyecto" class="form-label">Nombre del proyecto/Producto</label>
                <input type="text" class="form-control" id="nombreProyecto">
            </div>

            <!-- Tabla de materiales -->
            <table class="table table-bordered" id="materialTable">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">MTL</th>
                        <th scope="col">Material</th>
                        <th scope="col">Calibre Micras (μ)</th>
                        <th scope="col">Peso por m² (g/m²)</th>
                        <th scope="col">% Sólidos</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Se crean 5 filas por defecto -->
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control calibre" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control peso" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control calibre" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control peso" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control calibre" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control peso" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control calibre" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control peso" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control calibre" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control peso" oninput="calculateTotals()"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
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

            <!-- Botón para añadir más filas -->
            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">Añadir fila</button>

            <!-- Sección de procesos -->
            <div class="mb-3">
                <label for="proceso1" class="form-label">Paso 1</label>
                <input type="text" class="form-control" id="proceso1">
            </div>
            <div class="mb-3">
                <label for="proceso2" class="form-label">Paso 2</label>
                <input type="text" class="form-control" id="proceso2">
            </div>
            <div class="mb-3">
                <label for="proceso3" class="form-label">Paso 3</label>
                <input type="text" class="form-control" id="proceso3">
            </div>
            <div class="mb-3">
                <label for="proceso4" class="form-label">Paso 4</label>
                <input type="text" class="form-control" id="proceso4">
            </div>
            <div class="mb-3">
                <label for="proceso5" class="form-label">Paso 5</label>
                <input type="text" class="form-control" id="proceso5">
            </div>
            <div class="mb-3">
                <label for="proceso6" class="form-label">Paso 6</label>
                <input type="text" class="form-control" id="proceso6">
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
                </div>
                <!-- End of Content -->

            </div>
            <!-- End of Main Content -->

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
