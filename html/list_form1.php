<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$last_name = $_SESSION['user_last_name'];

// Conectar a la base de datos
include '../php/db_connection.php';

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Amcor</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>


            <!-- Nav Item - Formularios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForms"
                    aria-expanded="true" aria-controls="collapseForms">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Formularios</span>
                </a>
                <div id="collapseForms" class="collapse" aria-labelledby="headingForms" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones de Formularios:</h6>
                        <a class="collapse-item" href="inicio.php">Crear Formulario</a>
                        <a class="collapse-item" href="ver_estatus_formularios.php">Ver Estatus de Formularios</a>
                        <a class="collapse-item" href="aprobar_formularios.php">Aprobar Formularios</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones de Usuarios:</h6>
                        <a class="collapse-item" href="crear_cuenta.php">Crear Cuenta</a>
                    </div>
                </div>
            </li>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">

                        <!-- Main Content -->
                        <div id="content">

                            <!-- Topbar -->
                            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                                <!-- Sidebar Toggle (Topbar) -->
                                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                    <i class="fa fa-bars"></i>
                                </button>

                                <!-- Topbar Navbar -->
                                <ul class="navbar-nav ml-auto">

                                    <!-- User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                            // Mostrar el nombre del usuario logueado
                            if (isset($_SESSION['user_name']) && isset($_SESSION['user_last_name'])) {
                                echo '<span class="mr-2 d-none d-lg-inline text-gray-600">Bienvenido, ' 
                                    . $_SESSION['user_name'] . ' ' . $_SESSION['user_last_name'] . '</span>';
                            } else {
                                echo '<span class="mr-2 d-none d-lg-inline text-gray-600">Invitado</span>';
                            }
                            ?>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown">
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="logout.php">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Logout
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            <!-- End of Topbar -->
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
                                    echo "<tr>";
                                    echo "<td>" . $row['id_form1'] . "</td>";
                                    echo "<td>" . $row['project_name'] . "</td>";
                                    echo "<td>" . $row['name_client'] . "</td>";
                                    echo "<td>" . $row['name_user'] .' ('. $row['id_user']. ')'. "</td>";
                                    echo "<td>" . $row['status_form1'] . "</td>";
                                    // Botón de Ver Completo
                                    echo "<td><a href=show_form1.php?id=" . $row['id'] . "' class='btn btn-outline-primary btn-sm'>Ver completo</a> ";
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
                <!-- Main Content -->
                 
                <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->
                </div>
                <!-- End of Page Wrapper -->

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>
        </body>

        </html>
