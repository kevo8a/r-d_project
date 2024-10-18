<?php
include '../../php/db_connection.php';
include '../../php/auth.php';
// Consulta para obtener las cotizaciones
$sql = "SELECT id, id_form1, id_user, name_user, name_client, status_form1, project_name FROM form1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Formulario Cotización</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../structure/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../structure/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Main Content -->
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
                                <th>Acciones</th> <!-- Columna para el botón -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Mostrar datos de cada fila
                                while ($row = $result->fetch_assoc()) {
                                    // Definir la clase de color para el estatus basado en su valor
                                    $status_class = '';
                                    switch ($row['status_form1']) {
                                        case 'Complete':
                                            $status_class = 'bg-success text-white'; // Verde para "Aprobada"
                                            break;
                                        case 'Rechazado':
                                            $status_class = 'bg-danger text-white'; // Rojo para "Rechazado"
                                            break;
                                        case 'En Proceso':
                                            $status_class = 'bg-primary text-white'; // Azul para "En Proceso"
                                            break;
                                        case 'Corregir':
                                            $status_class = 'bg-warning text-dark'; // Naranja para "Corregir"
                                            break;
                                        default:
                                            $status_class = 'bg-secondary text-white'; // Color por defecto para otros casos
                                            break;
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $row['id_form1'] . "</td>";
                                    echo "<td>" . $row['project_name'] . "</td>";
                                    echo "<td>" . $row['name_client'] . "</td>";
                                    echo "<td>" . $row['name_user'] .' ('. $row['id_user']. ')'. "</td>";
                                    
                                    // Aplicar la clase de color al recuadro de estatus
                                    echo "<td class='$status_class'>" . $row['status_form1'] . "</td>";
                                    
                                    // Botón de Ver Completo
                                    echo "<td><a href='/r&d/html/forms/form1_show.php?id=" . $row['id'] . "' class='btn btn-outline-primary btn-sm'>Ver completo</a> ";

                                    // Mostrar el botón de Editar solo si el estatus es "Corregir"
                                    if ($row['status_form1'] === 'Corregir') {
                                        echo "<a href='/r&d/html/forms/form1_edit.php?id=" . $row['id'] . "' class='btn btn-outline-warning btn-sm ml-2'>Editar</a>";
                                    }

                                    echo "</td>"; // Asegúrate de cerrar la celda correctamente

                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay formularios creados</td></tr>";
                            }
                            ?>
                        </tbody>



                    </table>
                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../js/demo/chart-area-demo.js"></script>
        <script src="../js/demo/chart-pie-demo.js"></script>
    </div>
</body>

</html>