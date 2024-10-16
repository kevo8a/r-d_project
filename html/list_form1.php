<?php
// Iniciar la sesión antes de cualquier salida HTML
include '../php/db_connection.php';
session_start();

// Consulta para obtener las cotizaciones
$sql = "SELECT id, id_user, name_client, status_form1, project_name FROM form1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Formularios de Cotización</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- (Sección de la barra lateral omitida para reducir espacio) -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- (Barra superior omitida para reducir espacio) -->

                <!-- Main Content -->
                <div class="container-fluid mt-5">
                    <!-- Cambiado a container-fluid para ocupar todo el ancho -->
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h2 class="text-center">Formularios de Cotización</h2>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre del Proyecto</th>
                                                <th>Cliente</th>
                                                <th>Usuario</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                if ($result->num_rows > 0) {
                                    // Mostrar datos de cada fila
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['project_name'] . "</td>";
                                        echo "<td>" . $row['name_client'] . "</td>";
                                        echo "<td>" . $row['id_user'] . "</td>";
                                        echo "<td>" . $row['status_form1'] . "</td>";
                                        // Botón de Ver Completo
                                        echo "<td><a href='show_form1.php?id=" . $row['id'] . "' class='btn btn-outline-primary btn-sm'>Ver completo</a> ";
                                        // Botón de Editar
                                        // echo "<a href='edit_form1.php?id=" . $row['id'] . "' class='btn btn-outline-warning btn-sm'>Editar</a></td>"; 
                                        // echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No hay formularios creados</td></tr>";
                                }
                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
