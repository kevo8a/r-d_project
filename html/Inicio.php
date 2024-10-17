<?php
include '../php/db_connection.php';
include '../php/auth.php';
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'structure/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'structure/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Seleccione el formulario</h1>
                    <div class="row justify-content-center">

                        <!-- Opción Formulario Cotización -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <img src="https://cdn-icons-png.flaticon.com/128/6500/6500779.png" class="card-img-top mx-auto mt-3" alt="Icono Formulario Cotización" style="width: 128px;">
                                <div class="card-body text-center">
                                    <h2 class="card-title">Formulario Cotización</h2>
                                    <p class="card-text">Complete este formulario para solicitar una cotización de productos.</p>
                                    <a href="forms/form1.php" class="btn btn-primary">Ir al formulario</a>
                                </div>
                            </div>
                        </div>

                        <!-- Opción Formulario Solicitud Muestra -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <img src="https://cdn-icons-png.flaticon.com/128/6500/6500779.png" class="card-img-top mx-auto mt-3" alt="Icono Solicitud Muestra" style="width: 128px;">
                                <div class="card-body text-center">
                                    <h2 class="card-title">Formulario Solicitud Muestra</h2>
                                    <p class="card-text">Complete este formulario para solicitar una muestra de productos.</p>
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
