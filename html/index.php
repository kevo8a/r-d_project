<?php
include '../php/db_connection.php';
include '../php/auth.php';
// Obtener el ID del usuario logueado desde la sesión
$user_id = $_SESSION['user_id'];

?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>SB Admin 2 - Dashboard</title>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include 'structure/navbar.php'; ?>
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Content Row -->
                             
                            <?php if ($role == 1 || $role == 2): ?>
                            <div>
                                <h2>Todos los Forms En Proceso</h2>
                            </div>
                            <div class="row">
                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                 
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE status_form1 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE status_form2 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE status_form3 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE status_form4 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($role == 1 || $role == 2): ?>
                            <div>
                                <h2>Todos los Forms Correccion</h2>
                            </div>
                            <div class="row">
                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE status_form1 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion en Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE status_form2 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura en Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE status_form3 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra en Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE status_form4 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra en Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($role == 1 || $role == 2): ?>
                            <div>
                                <h2>Todos los Forms Aprobados</h2>
                            </div>
                            <div class="row">
                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE status_form1 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE status_form2 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE status_form3 = 'En proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE status_form4 = 'Aprobado'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra Aprobado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div>
                                <h2>Mis Forms Nuevos</h2>
                            </div>
                            <div class="row">

                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE id_user = $user_id AND status_form1 = 'Nuevo'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion Nuevo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE id_user = $user_id AND status_form2 = 'Nuevo'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura Nuevo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios con estatus "Nuevo" en form3
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE id_user = $user_id AND status_form3 = 'Nuevo'");
                                $row = $result->fetch_assoc();
                                $total_new_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra Nuevo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE id_user = $user_id AND status_form4 = 'Nuevo'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra Nuevo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.container-fluid -->
                            <div>
                                <h2>Mis Forms En Proceso</h2>
                            </div>
                            <div class="row">

                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE id_user = $user_id AND status_form1 = 'Nuevo'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion En Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE id_user = $user_id AND status_form2 = 'En Proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura En Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios con estatus "Nuevo" en form3
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE id_user = $user_id AND status_form3 = 'En Proceso'");
                                $row = $result->fetch_assoc();
                                $total_new_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra En Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE id_user = $user_id AND status_form4 = 'En Proceso'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra En Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h2>Mis Forms En Correccion</h2>
                            </div>
                            <div class="row">

                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE id_user = $user_id AND status_form1 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion En Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE id_user = $user_id AND status_form2 = 'En Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura En Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios con estatus "Nuevo" en form3
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE id_user = $user_id AND status_form3 = 'En Correccion'");
                                $row = $result->fetch_assoc();
                                $total_new_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra En Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE id_user = $user_id AND status_form4 = 'Correccion'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra En Correccion</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h2>Mis Forms Aprobados</h2>
                            </div>
                            <div class="row">

                                <!-- Usuarios Card -->
                                <!-- Formularios Card -->
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form1 WHERE id_user = $user_id AND status_form1 = 'Aprobado'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Contizacion Aprobados</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form2 WHERE id_user = $user_id AND status_form2 = 'Aprobado'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Diseño Estructura En Aprobados</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios con estatus "Nuevo" en form3
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form3 WHERE id_user = $user_id AND status_form3 = 'Aprobado'");
                                $row = $result->fetch_assoc();
                                $total_new_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Solicitud Muestra Aprobados</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Consulta para contar el número de formularios en proceso
                                $result = $conn->query("SELECT COUNT(*) as total_forms FROM form4 WHERE id_user = $user_id AND status_form4 = 'Aprobado'");
                                $row = $result->fetch_assoc();
                                $total_forms = $row['total_forms'];
                                ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Forms de Articulo Muestra Aprobados</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $total_forms; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->

                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
</body>

</html>