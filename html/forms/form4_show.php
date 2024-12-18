﻿<?php
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

                    <h1 class="text-center mb-4">Formulario Articulo Muestra</h1>
                    <form id="form-article" method="POST" enctype="multipart/form-data">
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
                                    value="<?php echo htmlspecialchars($row['project_name'] ?? ''); ?>" disabled>
                            </div>
                            <!-- Tipo de proyecto -->
                            <div class="col-md-3 mb-3">
                                <label for="type_project" class="form-label">Tipo de proyecto</label>
                                <select class="form-control" id="type_project" name="type_project" disabled>
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
                            <div class="col-md-3 mb-3">
                                <label for="start_plant" class="form-label">Planta Inicio</label>
                                <select class="form-control" id="start_plant" name="start_plant" disabled>
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
                            <!-- Planta Fin -->
                            <div class="col-md-3 mb-3">
                                <label for="end_plant" class="form-label">Planta Fin</label>
                                <select class="form-control" id="end_plant" name="end_plant" disabled>
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
                            <!-- TASK RAY -->
                            <div class="col-md-3 mb-3">
                                <label for="task_ray" class="form-label">Rayo de tarea</label>
                                <input type="text" class="form-control" id="task_ray" name="task_ray"
                                    value="<?php echo htmlspecialchars($row['task_ray'] ?? ''); ?>" disabled>
                            </div>
                            <!-- Tipo de envío -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="shipping_type" class="form-label">Tipo de envío</label>
                                    <select class="form-control" id="shipping_type" name="shipping_type" disabled>
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
                                    <select class="form-control" id="procces_type" name="procces_type" disabled>
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
                                <input type="number" class="form-control" id="n_task" name="n_task"
                                    value="<?php echo htmlspecialchars($row['n_task'] ?? ''); ?>" disabled>
                            </div>
                            <!-- TCH -->
                            <div class="col-md-3 mb-3">
                                <label for="TCH" class="form-label">TCH</label>
                                <input type="text" class="form-control" id="TCH" name="TCH"
                                    value="<?php echo htmlspecialchars($row['TCH'] ?? ''); ?>" disabled>
                            </div>
                            <!-- Sistema de impresíon -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="printing_system" class="form-label">Sistema de impresión</label>
                                    <select class="form-control" id="printing_system" name="printing_system" disabled>
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
                                    <select class="form-control" id="printing_type" name="printing_type" disabled>
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
                                    value="<?php echo htmlspecialchars($row['num_colors'] ?? ''); ?>" disabled>
                            </div>
                            <!-- Número de colores -->
                            <div class="col-md-9 mb-3">
                                <label for="photocell_colors">Colores</label>
                                <textarea id="photocell_colors" name="photocell_colors" class="form-control" rows="1"
                                    placeholder="Ingrese colores..."
                                    disabled><?php echo htmlspecialchars($row['photocell_colors'] ?? ''); ?></textarea>
                            </div>

                            <!-- Características de Calidad de Producto Terminado -->
                            <table class="table table-bordered" id="materialTable">
                                <thead class="table-warning">
                                    <tr>
                                        <th style="width: 30%;">Característica</th>
                                        <th style="width: 13.333%;">Unidad</th>
                                        <th style="width: 13.33%;">Valor Nominal</th>
                                        <th style="width: 13.33%;">Tolerancia</th>
                                        <th style="width: 30%;">Notas</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                        $counter = 1;
                                        $dataCount = count($data);
                                        $rowsToDisplay = max(14, $dataCount); // Garantiza al menos 14 filas iniciales

                                        for ($i = 0; $i < $rowsToDisplay; $i++) {
                                        $item = $i < $dataCount ? $data[$i] : ["feature" => "", "unit" => "", "value" => "", "tolerance" => "", "notes" => ""];

                                        // Verificar si la fila está dentro de las primeras 14
                                        $isReadOnly = $i < 14 ? 'readonly' : ''; 
                                        echo '<tr>';
                                        echo '<td><input type="text" name="feature'  . $counter . '" class="form-control" value="' . htmlspecialchars($item["feature"])   . '"readonly></td>';
                                        echo '<td><input type="text" name="unit'     . $counter . '" class="form-control" value="' . htmlspecialchars($item["unit"])      . '"readonly></td>';
                                        echo '<td><input type="text" name="value'    . $counter . '" class="form-control" value="' . htmlspecialchars($item["value"])     . '"readonly></td>';
                                        echo '<td><input type="text" name="tolerance'. $counter . '" class="form-control" value="' . htmlspecialchars($item["tolerance"]) . '"readonly></td>';
                                        echo '<td><input type="text" name="notes'    . $counter . '" class="form-control" value="' . htmlspecialchars($item["notes"])     . '"readonly></td>';
                                        echo '</tr>';
                                        $counter++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Sección de Datos adicionales de Impresión -->
                            <div class="col-md-12 mb-3" class="text-center">
                                <h4 class="mt-5">Datos adicionales de Impresión</h4>
                            </div>
                            <!-- Tabla para especificaciones de medidas del proyecto -->
                            <table class="table table-bordered">
                                <!-- Spot ancho (cm) -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="spot_width">SPOT ANCHO (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="spot_width" name="spot_width"
                                            value="<?php echo htmlspecialchars($row['spot_width'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Spot largo (cm) -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="spot_length">SPOT LARGO (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="spot_length" name="spot_length"
                                            value="<?php echo htmlspecialchars($row['spot_length'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Repetición (cm) -->
                                <tr>
                                    <th style="width: 21%; background-color: yellow;">
                                        <label for="repeat_cm">REPETICIÓN (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="repeat_cm" name="repeat_cm"
                                            style="background-color: yellow;"
                                            value="<?php echo htmlspecialchars($row['repeat_cm'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Repetición acumulada en 1 metro -->
                                <tr>
                                    <th style="width: 21%; background-color: yellow;">
                                        <label for="accumulative_repeat">REPETICIÓN ACUMULADA 1
                                            M</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="accumulative_repeat"
                                            name="accumulative_repeat" style="background-color: yellow;"
                                            value="<?php echo htmlspecialchars($row['accumulative_repeat'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                                <!-- Repetición real (cm) -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="actual_repeat">REPETICIÓN REAL (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="actual_repeat"
                                            name="actual_repeat"
                                            value="<?php echo htmlspecialchars($row['actual_repeat'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                                <!-- Repetición fotográfica (cm) -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="photographic_rep">REP. FOTOGRÁFICA (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="photographic_rep"
                                            name="photographic_rep"
                                            value="<?php echo htmlspecialchars($row['photographic_rep'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                                <!-- Cilindro/Manga (cm) -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="cylinder_sleeve">CILINDRO/ MANGA (cm)</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="cylinder_sleeve"
                                            name="cylinder_sleeve"
                                            value="<?php echo htmlspecialchars($row['cylinder_sleeve'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                                <!-- Número de repeticiones -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="n_repetitions">NUM DE REPETICIONES</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="n_repetitions"
                                            name="n_repetitions"
                                            value="<?php echo htmlspecialchars($row['n_repetitions'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                                <!-- Número de bobinas -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="n_reels">NUM DE BOBINAS</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="n_reels" name="n_reels"
                                            value="<?php echo htmlspecialchars($row['n_reels'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Poner línea de corte -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="cut_line">PONER LÍNEA DE CORTE</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="cut_line" name="cut_line"
                                            value="<?php echo htmlspecialchars($row['cut_line'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                            </table>
                            <!-- Tabla para especificaciones de medidas del proyecto -->
                            <table class="table table-bordered">
                                <!-- COLOR SPOT -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="spot_width">COLOR SPOT</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="spot_width" name="spot_width"
                                            value="NEGRO" disabled>
                                    </td>
                                </tr>
                                <!-- Area m2 -->
                                <tr>
                                    <th style="width: 21%;">
                                        <label for="area">Area m2</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="area" name="area"
                                            value="<?php echo htmlspecialchars($row['area'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Impresión x m2 -->
                                <tr>
                                    <th style="width: 21%; background-color: yellow;">
                                        <label for="repeat_cm">Impresión x m2</label>
                                    </th>
                                    <td>
                                        <input type="number" class="form-control" id="repeat_cm" name="repeat_cm"
                                            style="background-color: yellow;"
                                            value="<?php echo htmlspecialchars($row['repeat_cm'] ?? ''); ?>" disabled>
                                    </td>
                                </tr>
                                <!-- Impresión x m lineal -->
                                <tr>
                                    <th style="width: 21%; background-color: yellow;">
                                        <label for="print_linear">Impresión x m lineal</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="print_linear" name="print_linear"
                                            style="background-color: yellow;"
                                            value="<?php echo htmlspecialchars($row['print_linear'] ?? ''); ?>"
                                            disabled>
                                    </td>
                                </tr>
                            </table>
                            <!-- Sección de Descripción del Proyecto -->
                            <h4 class="mt-5">Descripción del Proyecto</h4>
                            <!-- Descripción del Proyecto -->
                            <div class="col-md-12 mb-3">
                                <label for="description">Descripción del Proyecto (Procesos, Sistema de
                                    impresión, Tintas especiales, etc):</label>
                                <textarea id="description" name="description" class="form-control" rows="3"
                                    placeholder="Describa el proyecto..."
                                    disabled><?php echo htmlspecialchars($row['description'] ?? ''); ?></textarea>
                            </div>
                            <!-- Sección de Descripción del Proyecto Arte-->
                            <div class="col-md-12 mb-3">
                                <label for="description_art">Descripción del Proyecto Arte:</label>
                                <textarea id="description_art" name="description_art" class="form-control" rows="3"
                                    placeholder="Describa el proyecto arte..."
                                    disabled><?php echo htmlspecialchars($row['description_art'] ?? ''); ?></textarea>
                            </div>
                            <!-- Especificaciones especiales -->
                            <div class="col-md-12 mb-3">
                                <label for="specs">Especificaciones especiales (uniones, empaque,
                                    ID):</label>
                                <textarea id="specs" name="specs" class="form-control" rows="3"
                                    placeholder="Ingrese especificaciones especiales..."
                                    disabled><?php echo htmlspecialchars($row['specs'] ?? ''); ?></textarea>
                            </div>
                            <!-- Campos del formulario de envío -->
                            <div class="col-md-12 text-center mt-3">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back()">Regresar</button>
                            </div>
                        </div>
                    </form>
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