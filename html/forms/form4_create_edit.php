<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener ID del registro a editar
$id = $_GET['id'];

// Obtener datos del registro
$sql = "SELECT * FROM form4 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data = json_decode($row['table_content'], true); // Decodificar JSON a un array
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
                        <div class="col-md-3 mb-3">
                            <label for="name_user" class="form-label">Solicitante</label>
                            <input type="text" class="form-control" id="solicitante" name="name_user"
                                value="<?php echo htmlspecialchars($row['name_user'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Site -->
                        <div class="col-md-3 mb-3">
                            <label for="site_user" class="form-label">Sitio</label>
                            <input type="text" class="form-control" id="site_user" name="site_user"
                                value="<?php echo htmlspecialchars($row['site_user'] ?? ''); ?>" disabled>
                        </div>

                        <!-- ID Usuario -->
                        <div class="col-md-3 mb-3">
                            <label for="id_user" class="form-label">ID del Usuario</label>
                            <input type="text" class="form-control" id="id_user" name="id_user"
                                value="<?php echo htmlspecialchars($row['id_user'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Calificado por -->
                        <div class="col-md-3 mb-3">
                            <label for="qualified_by" class="form-label">Calificado por</label>
                            <input type="text" class="form-control" id="qualified_by" name="qualified_by"
                                value="<?php echo htmlspecialchars($row['qualified_by'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Fecha de creación -->
                        <div class="col-md-3 mb-3">
                            <label for="created_at" class="form-label">Fecha de creación</label>
                            <input type="text" class="form-control" id="created_at" name="created_at"
                                value="<?php echo htmlspecialchars($row['created_at'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Fecha de finalización -->
                        <div class="col-md-3 mb-3">
                            <label for="completed_at" class="form-label">Fecha de finalización</label>
                            <input type="text" class="form-control" id="completed_at" name="completed_at"
                                value="<?php echo htmlspecialchars($row['completed_at'] ?? ''); ?>" disabled>
                        </div>
                        <!-- Estatus -->
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Estatus</label>
                            <input type="text" class="form-control" id="status" name="status"
                                value="<?php echo htmlspecialchars($row['status_form4'] ?? ''); ?>" disabled>
                        </div>

                        <!-- folio -->
                        <div class="col-md-3 mb-3">
                            <label for="folio" class="form-label">Folio</label>
                            <input type="text" class="form-control" id="folio" name="folio"
                                value="<?php echo htmlspecialchars($row['id_form4'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Cliente -->
                        <div class="col-md-3 mb-3">
                            <label for="client" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="client" name="client"
                                value="<?php echo htmlspecialchars($row['name_client'] ?? ''); ?>" disabled>
                        </div>

                        <!-- Nombre de proyecto -->
                        <div class="col-md-3 mb-3">
                            <label for="project_name" class="form-label">Nombre del
                                Proyecto/Producto</label>
                            <input type="text" class="form-control" id="project_name" name="project_name"
                                value="<?php echo htmlspecialchars($row['project_name'] ?? ''); ?>">
                        </div>

                        <!-- Tipo de proyecto -->
                        <div class="col-md-3 mb-3">
                            <label for="type_project" class="form-label">Tipo de proyecto</label>
                            <select class="form-control" id="type_project" name="type_project">
                                <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                <option value="Muestra"
                                    <?php echo (isset($row['type_project']) && $row['type_project'] === 'Muestra') ? 'selected' : ''; ?>>
                                    Muestra</option>
                                <option value="Escalamiento/OE"
                                    <?php echo (isset($row['type_project']) && $row['type_project'] === 'Escalamiento/OE') ? 'selected' : ''; ?>>
                                    Escalamiento/OE</option>
                            </select>
                        </div>


                        <!-- Planta Inicio -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="start_plant" class="form-label">Planta Inicio</label>
                                <select class="form-control" id="start_plant" name="start_plant" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Zacapu"
                                        <?php echo (isset($row['start_plant']) && $row['start_plant'] === 'Zacapu') ? 'selected' : ''; ?>>
                                        Zacapu</option>
                                    <option value="Tlaquepaque"
                                        <?php echo (isset($row['start_plant']) && $row['start_plant'] === 'Tlaquepaque') ? 'selected' : ''; ?>>
                                        Tlaquepaque</option>
                                    <option value="Tultitlán"
                                        <?php echo (isset($row['start_plant']) && $row['start_plant'] === 'Tultitlán') ? 'selected' : ''; ?>>
                                        Tultitlán</option>
                                </select>
                            </div>
                        </div>

                        <!-- Planta Fin -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="end_plant" class="form-label">Planta Fin</label>
                                <select class="form-control" id="end_plant" name="end_plant" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Zacapu"
                                        <?php echo (isset($row['end_plant']) && $row['end_plant'] === 'Zacapu') ? 'selected' : ''; ?>>
                                        Zacapu</option>
                                    <option value="Tlaquepaque"
                                        <?php echo (isset($row['end_plant']) && $row['end_plant'] === 'Tlaquepaque') ? 'selected' : ''; ?>>
                                        Tlaquepaque</option>
                                    <option value="Tultitlán"
                                        <?php echo (isset($row['end_plant']) && $row['end_plant'] === 'Tultitlán') ? 'selected' : ''; ?>>
                                        Tultitlán</option>
                                </select>
                            </div>
                        </div>
                        <!-- TASK RAY -->
                        <div class="col-md-3 mb-3">
                            <label for="task_ray" class="form-label">Rayo de tarea</label>
                            <input type="text" class="form-control" id="task_ray" name="task_ray"
                                value="<?php echo htmlspecialchars($row['task_ray'] ?? ''); ?>">
                        </div>

                        <!-- Tipo de envío -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="shipping_type" class="form-label">Tipo de envío</label>
                                <select class="form-control" id="shipping_type" name="shipping_type" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Nacional"
                                        <?php echo (isset($row['shipping_type']) && $row['shipping_type'] === 'Nacional') ? 'selected' : ''; ?>>
                                        Nacional</option>
                                    <option value="Exportación"
                                        <?php echo (isset($row['shipping_type']) && $row['shipping_type'] === 'Exportación') ? 'selected' : ''; ?>>
                                        Exportación</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tipo de proceso -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="procces_type" class="form-label"> Tipo de proceso</label>
                                <select class="form-control" id="procces_type" name="procces_type" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Standard trials"
                                        <?php echo (isset($row['procces_type']) && $row['procces_type'] === 'Standard trials') ? 'selected' : ''; ?>>
                                        Standard trials</option>
                                    <option value="Non-Standard trials"
                                        <?php echo (isset($row['procces_type']) && $row['procces_type'] === 'Non-Standard trials') ? 'selected' : ''; ?>>
                                        Non-Standard trials</option>
                                </select>
                            </div>
                        </div>

                        <!-- #Task Ray -->
                        <div class="col-md-3 mb-3">
                            <label for="n_task" class="form-label">#Task Ray</label>
                            <input type="text" class="form-control" id="n_task" name="n_task"
                                value="<?php echo htmlspecialchars($row['n_task'] ?? ''); ?>">
                        </div>

                        <!-- TCH -->
                        <div class="col-md-3 mb-3">
                            <label for="TCH" class="form-label">TCH</label>
                            <input type="text" class="form-control" id="TCH" name="TCH"
                                value="<?php echo htmlspecialchars($row['TCH'] ?? ''); ?>">
                        </div>
                        <!-- Sistema de impresíon -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="printing_system" class="form-label">Sistema de impresión</label>
                                <select class="form-control" id="printing_system" name="printing_system" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Rotograbado"
                                        <?php echo (isset($row['printing_system']) && strpos($row['printing_system'], 'Rotograbado') !== false) ? 'selected' : ''; ?>>
                                        Rotograbado</option>
                                    <option value="Flexografía"
                                        <?php echo (isset($row['printing_system']) && strpos($row['printing_system'], 'Flexografía') !== false) ? 'selected' : ''; ?>>
                                        Flexografía</option>
                                    <option value="Sin impresión"
                                        <?php echo (isset($row['printing_system']) && strpos($row['printing_system'], 'Sin impresión') !== false) ? 'selected' : ''; ?>>
                                        Sin impresión</option>
                                </select>
                            </div>
                        </div>


                        <!-- Tipo de impresíon -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="printing_type" class="form-label">Tipo de impresión</label>
                                <select class="form-control" id="printing_type" name="printing_type" required>
                                    <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                                    <option value="Interna"
                                        <?php echo (isset($row['printing_type']) && $row['printing_type'] === 'Interna') ? 'selected' : ''; ?>>
                                        Interna</option>
                                    <option value="Externa"
                                        <?php echo (isset($row['printing_type']) && $row['printing_type'] === 'Externa') ? 'selected' : ''; ?>>
                                        Externa</option>
                                </select>
                            </div>
                        </div>

                        <!-- Número de colores -->
                        <div class="col-md-3 mb-3">
                            <label for="num_colors" class="form-label">Número de colores</label>
                            <input type="text" class="form-control" id="num_colors" name="num_colors"
                                value="<?php echo htmlspecialchars($row['num_colors'] ?? ''); ?>">
                        </div>
                        <!-- Colores -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="photocell_colors" class="form-label">Colores</label>
                                <input type="text" class="form-control" id="photocell_colors" name="photocell_colors"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['photocell_colors']) : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <!-- Características de Calidad de Producto Terminado -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Caracteristica</th>
                                    <th>UNID</th>
                                    <th>VALOR NOMINAL</th>
                                    <th>Tolerancia</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody id="calidadBody">
                                <tr>
                                    <td><input type="text" name= "feature1"class="form-control" value="<?php echo htmlspecialchars($data[0]["feature"] ?? 'GRAMA44JE'); ?>" required></td>
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
                                <tr>
                                    <td><button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar
                                            fila</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <!-- Sección de Datos adicionales de Impresión -->

                        <div class="text-center">
                            <h4 class="mt-5">Datos adicionales de Impresión</h4>
                        </div>

                        <!-- Spot ancho (cm) -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="spot_width" class="form-label">Spot ancho (cm) </label>
                                <input type="text" class="form-control" id="spot_width" name="spot_width"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['spot_width']) : ''; ?>"
                                    required>
                            </div>
                        </div>
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