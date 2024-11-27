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

                    <h2 class="mb-4">Formulario de Proyecto</h2>
                    <div class="row">
                        <!-- Solicitante -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="solicitante" class="form-label">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" value="<?php 
                                        // Verifica si está en modo edición (si $form_data['name_user'] tiene un valor guardado)
                                        if (isset($form_data['name_user']) && !empty($form_data['name_user'])) {
                                            echo htmlspecialchars($form_data['name_user'], ENT_QUOTES, 'UTF-8'); 
                                        } else {
                                                // Si no, muestra el nombre por defecto
                                                echo htmlspecialchars($name . ' ' . $last_name, ENT_QUOTES, 'UTF-8'); // Ajusta esto según lo que necesites
                                        }
                                    ?>" readonly>
                            </div>
                        </div>
                        <!-- Site -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="site" class="form-label">Site</label>
                                <input type="text" class="form-control" id="site" name="site_user" value="<?php 
                                            // Verifica si está en modo edición (si $form_data['site_user'] tiene un valor guardado)
                                            if (isset($form_data['site_user']) && !empty($form_data['site_user'])) {
                                                echo htmlspecialchars($form_data['site_user'], ENT_QUOTES, 'UTF-8'); 
                                            } else {
                                                // Muestra un valor por defecto cuando no hay un site_user
                                                echo htmlspecialchars($site, ENT_QUOTES, 'UTF-8'); // Cambia $default_site por el valor por defecto que quieras
                                            }
                                        ?>" readonly>
                            </div>
                        </div>

                        <!-- ID Usuario -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="id_user" class="form-label">ID del Usuario</label>
                                <input type="text" class="form-control" id="id_user" name="id_user" value="<?php 
                                            // Verifica si está en modo edición (si $form_data['id_user'] tiene un valor guardado)
                                            if (isset($form_data['id_user']) && !empty($form_data['id_user'])) {
                                                echo htmlspecialchars($form_data['id_user'], ENT_QUOTES, 'UTF-8'); 
                                            } else {
                                                // Muestra un valor por defecto cuando no hay un id_user
                                                echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); // Cambia $default_id_user por el valor por defecto que quieras
                                            }
                                        ?>" readonly>
                            </div>
                        </div>

                        <!-- Calificado por -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="qualified_by" class="form-label">Calificado por</label>
                                <input type="text" class="form-control" id="qualified_by" name="qualified_by"
                                    value="<?php echo isset($id_formulario) && $id_formulario ? htmlspecialchars($form_data['qualified_by']) : ''; ?>"
                                    readonly>
                            </div>
                        </div>

                        <!-- Fecha de creación -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="created_at" class="form-label">Fecha de creación</label>
                                <input type="text" class="form-control" id="created_at" name="created_at" readonly
                                    value="<?php 
                                            // Verifica si está en modo edición (si $form_data['created_at'] tiene un valor guardado)
                                            echo isset($form_data['created_at']) && !empty($form_data['created_at']) 
                                                ? htmlspecialchars($form_data['created_at'], ENT_QUOTES, 'UTF-8') 
                                                : date('d-m-Y H:i'); // Muestra la fecha actual si no hay un valor guardado
                                        ?>">
                            </div>
                        </div>

                        <!-- Fecha de finalización -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="completed_at" class="form-label">Fecha de finalización</label>
                                <input type="text" class="form-control" id="completed_at" name="completed_at"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['completed_at']) : ''; ?>"
                                    readonly>
                            </div>
                        </div>
                        <!-- Estatus -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="status" class="form-label">Estatus</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['status_form4']) : 'En Proceso'; ?>"
                                    readonly>
                            </div>
                        </div>

                        <!-- folio -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="folio" class="form-label">Folio</label>
                                <input type="text" class="form-control" id="folio" name="folio"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['id_form4']): ''; ?>"
                                    readonly>
                            </div>
                        </div>
                        <!-- Cliente -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente</label>
                                <select class="form-control" id="cliente" name="cliente" required>
                                    <option value="" disabled selected>Selecciona un cliente</option>
                                    <?php
                                        require '../../php/db_connection.php';

                                        $sql_clientes = "SELECT name FROM client";
                                        $result_clientes = mysqli_query($conn, $sql_clientes);

                                        if ($result_clientes) {
                                            while ($row_cliente = mysqli_fetch_assoc($result_clientes)) {
                                                // Selecciona el cliente actual del formulario si se está editando
                                                $selected = ($id_formulario && $row_cliente['name'] == $form_data['name_client']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($row_cliente['name']) . '" ' . $selected . '>' . htmlspecialchars($row_cliente['name']) . '</option>';
                                            }
                                        }

                                        mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>

                        <!-- Nombre de proyecto -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="nombre_proyecto" class="form-label">Nombre del
                                    Proyecto/Producto</label>
                                <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['project_name']) : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="project">Proyecto:</label>
                                <input type="text" id="project" class="form-control" placeholder="Ingrese el proyecto">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="startPlant">PLANTA INICIO:</label>
                                <input type="text" id="startPlant" class="form-control"
                                    placeholder="Ingrese Planta Inicio">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="endPlant">PLANTA FIN (SI ES DIFERENTE):</label>
                                <input type="text" id="endPlant" class="form-control"
                                    placeholder="Planta Fin (si es diferente)">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="taskRay">TASK RAY:</label>
                                <input type="text" id="taskRay" class="form-control" placeholder="Ingrese Task Ray">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="shippingType">TIPO DE ENVÍO:</label>
                                <input type="text" id="shippingType" class="form-control"
                                    placeholder="Ingrese el tipo de envío">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="processType">TIPO DE PROCESO:</label>
                                <input type="text" id="processType" class="form-control" placeholder="Tipo de proceso">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="taskRayNum">#Task Ray:</label>
                                <input type="text" id="taskRayNum" class="form-control" placeholder="#Task Ray">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="tch">TCH:</label>
                                <input type="text" id="tch" class="form-control" placeholder="TCH">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="printingSystem">Sistema de Impresión:</label>
                                <input type="text" id="printingSystem" class="form-control"
                                    placeholder="Sistema de Impresión">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="printingType">Tipo de Impresión:</label>
                                <input type="text" id="printingType" class="form-control"
                                    placeholder="Tipo de Impresión">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="numColors">#Colores:</label>
                                <input type="number" id="numColors" class="form-control" placeholder="#Colores">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center">
                                <h4 class="mt-5">Características de Calidad de Producto Terminado </h4>
                            </div>
                        </div>

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
                                    <td><input type="text" class="form-control" value="SOLVENTES RETENIDOS">
                                    </td>
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
                                            value="RESISTENCIA TERMICA(180°C-1 SEG-40PSI)">
                                    </td>
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
                                    <td><input type="text" class="form-control" value="TRANSMISION DE OXIGENO">
                                    </td>
                                    <td><input type="text" class="form-control" value="cc/m2 día"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" value="Resistencia al ROCE-tinta">
                                    </td>
                                    <td><input type="text" class="form-control" value="Ciclos, peso, probetas">
                                    </td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Botón para agregar fila -->
                        <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar
                            fila</button>
                        <!-- Sección de Datos adicionales de Impresión -->

                        <div class="text-center">
                            <h4 class="mt-5">Datos adicionales de Impresión</h4>
                        </div>

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
                                    <td><input type="text" class="form-control" style="background-color: yellow;">
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="background-color: yellow;">REPETICIÓN ACUMULADA 1 M
                                    </th>
                                    <td><input type="text" class="form-control" style="background-color: yellow;">
                                    </td>
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Descripción del Proyecto (Procesos, Sistema de impresión, Tintas especiales,
                                    etc):</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Describa el proyecto..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Descripción del Proyecto Arte:</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Describa el proyecto arte..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Especificaciones especiales (uniones, empaque, ID):</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Ingrese especificaciones especiales..."></textarea>
                            </div>
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