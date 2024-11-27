<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener el ID del formulario de la URL (para editar)
$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];

// Si hay un ID, consultar los datos del formulario por su ID
if ($id_formulario) {
    $sql = "SELECT * FROM form4 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_formulario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró el formulario
    if ($result->num_rows === 0) {
        die('Formulario no encontrado.');
    }
    // Obtener los datos del formulario
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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
                        <h2 class="mb-4">Formulario de Proyecto</h2>

                        <!-- Datos del Proyecto -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Nombre del Proyecto/Producto:</label>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del proyecto">
                            </div>
                            <div class="col-md-4">
                                <label>Proyecto:</label>
                                <input type="text" class="form-control" placeholder="Ingrese el proyecto">
                            </div>
                            <div class="col-md-4">
                                <label>PLANTA INICIO:</label>
                                <input type="text" class="form-control" placeholder="Ingrese Planta Inicio">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>PLANTA FIN (SI ES DIFERENTE):</label>
                                <input type="text" class="form-control" placeholder="Planta Fin (si es diferente)">
                            </div>
                            <div class="col-md-4">
                                <label>TASK RAY:</label>
                                <input type="text" class="form-control" placeholder="Ingrese Task Ray">
                            </div>
                            <div class="col-md-4">
                                <label>TIPO DE ENVÍO:</label>
                                <input type="text" class="form-control" placeholder="Ingrese el tipo de envío">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>TIPO DE PROCESO:</label>
                                <input type="text" class="form-control" placeholder="Tipo de proceso">
                            </div>
                            <div class="col-md-4">
                                <label>#Task Ray:</label>
                                <input type="text" class="form-control" placeholder="#Task Ray">
                            </div>
                            <div class="col-md-4">
                                <label>TCH:</label>
                                <input type="text" class="form-control" placeholder="TCH">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Sistema de Impresión:</label>
                                <input type="text" class="form-control" placeholder="Sistema de Impresión">
                            </div>
                            <div class="col-md-4">
                                <label>Tipo de Impresión:</label>
                                <input type="text" class="form-control" placeholder="Tipo de Impresión">
                            </div>
                            <div class="col-md-4">
                                <label>#Colores:</label>
                                <input type="number" class="form-control" placeholder="#Colores">
                            </div>
                        </div>

                        <h4 class="mt-5">Características de Calidad de Producto Terminado</h4>

                        <!-- Características de Calidad de Producto Terminado -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>CARACTERÍSTICA</th>
                                    <th>UNID</th>
                                    <th>VALOR NOMINAL</th>
                                    <th>Tolerancia</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody id="calidadBody">
                                <tr>
                                    <td><input type="text" class="form-control" value="GRAMAJE"></td>
                                    <td><input type="text" class="form-control" value="g/m2"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="CALIBRE"></td>
                                    <td><input type="text" class="form-control" value="micras"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="COF ext/ext"></td>
                                    <td><input type="text" class="form-control" value="-"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="COF int/int"></td>
                                    <td><input type="text" class="form-control" value="-"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="FUERZA DE SELLADO"></td>
                                    <td><input type="text" class="form-control" value="g/25 mm"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="FUERZA DE ADHERENCIA 1ra lam">
                                    </td>
                                    <td><input type="text" class="form-control" value="g/25 mm"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="FUERZA DE ADHERENCIA 2da Lam">
                                    </td>
                                    <td><input type="text" class="form-control" value="g/25 mm"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="SOLVENTES RETENIDOS"></td>
                                    <td><input type="text" class="form-control" value="mg/m2"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="DUREZA"></td>
                                    <td><input type="text" class="form-control" value="kN"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"
                                            value="RESISTENCIA TERMICA(180°C-1 SEG-40PSI)"></td>
                                    <td><input type="text" class="form-control" value="-"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="CHOQUE TÉRMICO"></td>
                                    <td><input type="text" class="form-control" value="-"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="TRANSMISION DE VAPOR DE AGUA">
                                    </td>
                                    <td><input type="text" class="form-control" value="g/m2 día"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="TRANSMISION DE OXIGENO"></td>
                                    <td><input type="text" class="form-control" value="cc/m2 día"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="Resistencia al ROCE-tinta"></td>
                                    <td><input type="text" class="form-control" value="Ciclos, peso, probetas"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Botón para agregar fila -->
                        <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar fila</button>

                        <h4 class="mt-5">Datos adicionales de Impresión</h4>

                        <!-- Sección de Datos adicionales de Impresión -->
                        <h4 class="mt-5">Datos adicionales de Impresión</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">SPOT ANCHO (cm)</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">SPOT LARGO (cm)</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="background-color: yellow">REPETICIÓN (cm)</th>
                                    <td><input type="text" class="form-control" style="background-color: yellow;"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="background-color: yellow;">REPETICIÓN ACUMULADA 1 M</th>
                                    <td><input type="text" class="form-control" style="background-color: yellow;"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">REPETICIÓN REAL (cm)</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">REP. FOTOGRÁFICA (cm)</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">CILINDRO/ MANGA (cm)</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">NUM DE REPETICIONES</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">NUM DE BOBINAS</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th colspan="2">PONER LÍNEA DE CORTE</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </thead>
                        </table>

                        <!-- Sección de Descripción del Proyecto -->
                        <h4 class="mt-5">Descripción del Proyecto</h4>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>Descripción del Proyecto (Procesos, Sistema de impresión, Tintas especiales,
                                    etc):</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Describa el proyecto..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>Descripción del Proyecto Arte:</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Describa el proyecto arte..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>Especificaciones especiales (uniones, empaque, ID):</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Ingrese especificaciones especiales..."></textarea>
                            </div>
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