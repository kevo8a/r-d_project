<?php
// Iniciar la sesión antes de cualquier salida HTML
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Selección de Formulario</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
                        <a class="collapse-item" href="list_form1.php">Forms Cotización</a>
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

                <!-- Main Content -->
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Seleccione el formulario</h1>
                    <div class="row justify-content-center">

                        <!-- Opción Formulario Cotización -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <img src="https://cdn-icons-png.flaticon.com/128/6500/6500779.png"
                                    class="card-img-top mx-auto mt-3" alt="Icono Formulario Cotización"
                                    style="width: 128px;">
                                <div class="card-body text-center">
                                    <h2 class="card-title">Formulario Cotización</h2>
                                    <p class="card-text">Complete este formulario para solicitar una cotización de
                                        productos.</p>
                                    <a href="../html/form1.php" class="btn btn-primary">Ir al formulario</a>
                                </div>
                            </div>
                        </div>

                        <!-- Opción Formulario Solicitud Muestra -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <img src="https://cdn-icons-png.flaticon.com/128/6500/6500779.png"
                                    class="card-img-top mx-auto mt-3" alt="Icono Solicitud Muestra"
                                    style="width: 128px;">
                                <div class="card-body text-center">
                                    <h2 class="card-title">Formulario Solicitud Muestra</h2>
                                    <p class="card-text">Complete este formulario para solicitar una muestra de
                                        productos.</p>
                                    <a href="/formulario-solicitud-muestra" class="btn btn-primary">Ir al formulario</a>
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

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    </div>
    </body>

</html>