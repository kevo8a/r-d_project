<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener el ID del formulario de la URL (para editar)
$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];

// Si hay un ID, consultar los datos del formulario por su ID
if ($id_formulario) {
    $sql = "SELECT * FROM form3 WHERE id = ?";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Solicitud Muestra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/js.js"></script>
</head>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Navbar -->
                <?php include '../structure/navbar.php'; ?>

                <!-- Contenido del Formulario -->
                <div class="container">
                    <h1 class="text-center mb-4"><?php echo $id_formulario ? 'Editar' : 'Crear'; ?> Formulario de
                        Solicitud Muestra</h1>
                    <form id="form-cotizacion" method="POST" enctype="multipart/form-data">
                        <?php if ($id_formulario): ?>
                        <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">
                        <?php endif; ?>
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
                                    <label for="estatus" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['status_form3']) : 'En Proceso'; ?>"
                                        readonly>
                                </div>
                            </div>

                            <!-- folio -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['id_form3']): ''; ?>"
                                        readonly>
                                </div>
                            </div>
                            <!-- Cliente -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>

                                    <?php
                                require '../../php/db_connection.php';

                                // Obtener clientes de la base de datos
                                $sql_clientes = "SELECT name FROM client";
                                $result_clientes = mysqli_query($conn, $sql_clientes);

                                // Revisar si el formulario está en modo edición y tiene un cliente asignado
                                $isReadOnly = ($id_formulario && !empty($form_data['name_client'])) ? 'disabled' : '';
                                ?>

                                    <!-- Lista de selección de cliente, desactivada si ya tiene cliente asignado -->
                                    <select class="form-control" id="cliente" name="cliente" required
                                        <?= $isReadOnly ?>>
                                        <option value="" disabled <?= !$id_formulario ? 'selected' : '' ?>>Selecciona un
                                            cliente</option>

                                        <?php
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto/Producto</label>
                                    <?php
                                // Determinar si el campo debe estar en solo lectura (readonly) si tiene un valor de proyecto
                                $isReadOnly = ($id_formulario && !empty($form_data['project_name'])) ? 'readonly' : '';
                                ?>
                                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['project_name']) : ''; ?>"
                                        required <?= $isReadOnly ?>>

                                </div>
                            </div>
                            <!-- Cantidad Solicitada -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cantidad_solicitada" class="form-label">Cantidad Solicitada</label>
                                    <?php
                                    // Determinar si el campo debe estar en solo lectura (readonly) si tiene un valor de cantidad solicitada
                                    $isReadOnly = ($id_formulario && !empty($form_data['requested_qty'])) ? : '';
                                    ?>
                                    <input type="text" class="form-control" id="cantidad_solicitada"
                                        name="cantidad_solicitada"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['requested_qty']) : ''; ?>"
                                        required <?= $isReadOnly ?>>
                                </div>
                            </div>

                            <!-- Unidades Cantidad Solicitada -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unidadCantidad" class="form-label">Unidades Cantidad Solicitada</label>
                                    <select class="form-select" id="unidadCantidad" name="unidad_cantidad">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        <option value="unidades"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'unidades') ? 'selected' : ''; ?>>
                                            Unidades</option>
                                        <option value="kilogramos"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'kilogramos') ? 'selected' : ''; ?>>
                                            Kilogramos (KG)</option>
                                        <option value="metros"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'metros') ? 'selected' : ''; ?>>
                                            Metros</option>
                                        <option value="rollos"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'rollos') ? 'selected' : ''; ?>>
                                            Rollos</option>
                                        <option value="km"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'km') ? 'selected' : ''; ?>>
                                            Kilómetro (KM)</option>
                                        <option value="pieza"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'pieza') ? 'selected' : ''; ?>>
                                            Pieza (PC)</option>
                                        <option value="millares"
                                            <?php echo (isset($form_data['requested_units']) && $form_data['requested_units'] == 'millares') ? 'selected' : ''; ?>>
                                            Millares</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Muestra Facturable -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="facturable" class="form-label">Muestra Facturable</label>
                                    <select class="form-select" id="facturable" name="facturable">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        <option value="si"
                                            <?php echo (isset($form_data['billable_sample']) && $form_data['billable_sample'] == 'si') ? 'selected' : ''; ?>>
                                            Sí</option>
                                        <option value="no"
                                            <?php echo (isset($form_data['billable_sample']) && $form_data['billable_sample'] == 'no') ? 'selected' : ''; ?>>
                                            No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ¿Fotocelda? -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fotocelda" class="form-label">¿Fotocelda?</label>
                                    <select class="form-select" id="fotocelda" name="fotocelda">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        <option value="si"
                                            <?php echo (isset($form_data['photocell']) && $form_data['photocell'] == 'si') ? 'selected' : ''; ?>>
                                            Sí</option>
                                        <option value="no"
                                            <?php echo (isset($form_data['photocell']) && $form_data['photocell'] == 'no') ? 'selected' : ''; ?>>
                                            No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Número de Colores -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numColores" class="form-label">Número de Colores</label>
                                    <input type="number" class="form-control" id="numColores" name="num_colores"
                                        value="<?php echo isset($form_data['num_colors']) ? htmlspecialchars($form_data['num_colors']) : ''; ?>" />
                                </div>
                            </div>
                            <!-- Colores de la Fotocelda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coloresFotocelda" class="form-label">Colores de la Fotocelda</label>
                                    <input type="text" class="form-control" id="coloresFotocelda"
                                        name="colores_fotocelda"
                                        value="<?php echo isset($form_data['colores_fotocelda']) ? htmlspecialchars($form_data['colores_fotocelda']) : ''; ?>" />
                                </div>
                            </div>
                            <!-- Sistema de Impresión -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistemaImpresion" class="form-label">Sistema de Impresión</label>
                                    <select class="form-select" id="sistemaImpresion" name="sistema_impresion"
                                        onchange="toggleColores()">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        <option value="rotograbado"
                                            <?php echo (isset($form_data['printing_system']) && $form_data['printing_system'] == 'rotograbado') ? 'selected' : ''; ?>>
                                            Rotograbado</option>
                                        <option value="flexografia"
                                            <?php echo (isset($form_data['printing_system']) && $form_data['printing_system'] == 'flexografia') ? 'selected' : ''; ?>>
                                            Flexografía</option>
                                        <option value="sinImpresion"
                                            <?php echo (isset($form_data['printing_system']) && $form_data['printing_system'] == 'sinImpresion') ? 'selected' : ''; ?>>
                                            Sin impresión</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Dimensiones -->
                            <h4 class="mt-5">Dimensiones</h4>

                            <!-- Diámetro Externo (mm) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diamExt" class="form-label">Diámetro Externo (mm)</label>
                                    <!-- Este campo permite ingresar el valor del diámetro externo en milímetros -->
                                    <input type="number" class="form-control" id="diamExt">
                                </div>
                            </div>

                            <!-- Signo de Tolerancia para el Diámetro Externo -->
                            <div class="col-md-3">
                                <label for="signoDiamExt" class="form-label">Signo Tolerancia</label>
                                <!-- Este campo permite ingresar el signo de la tolerancia para el diámetro externo (por ejemplo, + o -) -->
                                <input type="text" class="form-control" id="signoDiamExt">
                            </div>

                            <!-- Tolerancia del Diámetro Externo (mm) -->
                            <div class="col-md-3">
                                <label for="toleranciaDiamExt" class="form-label">Tolerancia Diámetro Externo (mm)</label>
                                <!-- Este campo permite ingresar el valor de la tolerancia en milímetros para el diámetro externo -->
                                <input type="text" class="form-control" id="toleranciaDiamExt">
                            </div>

                            <div class="row mb-3">
                                <!-- Diámetro Interno (pulgadas) -->
                                <div class="col-md-6">
                                    <label for="diamInt" class="form-label">Diámetro Interno (pulgadas)</label>
                                    <!-- Este campo permite ingresar el valor del diámetro interno en pulgadas -->
                                    <input type="number" class="form-control" id="diamInt">
                                </div>
                                <!-- Signo de Tolerancia para el Diámetro Interno -->
                                <div class="col-md-3">
                                    <label for="signoDiamInt" class="form-label">Signo Tolerancia</label>
                                    <!-- Este campo permite ingresar el signo de la tolerancia para el diámetro interno (por ejemplo, + o -) -->
                                    <input type="text" class="form-control" id="signoDiamInt">
                                </div>
                                <!-- Tolerancia del Diámetro Interno (pulgadas) -->
                                <div class="col-md-3">
                                    <label for="toleranciaDiamInt" class="form-label">Tolerancia Diámetro Interno (pulgadas)</label>
                                    <!-- Este campo permite ingresar el valor de la tolerancia en pulgadas para el diámetro interno -->
                                    <input type="text" class="form-control" id="toleranciaDiamInt">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Ancho de Bobina (mm) -->
                                <div class="col-md-6">
                                    <label for="anchoBobina" class="form-label">Ancho de Bobina (mm)</label>
                                    <!-- Este campo permite ingresar el valor del ancho de la bobina en milímetros -->
                                    <input type="number" class="form-control" id="anchoBobina">
                                </div>
                                <!-- Signo de Tolerancia para el Ancho de Bobina -->
                                <div class="col-md-3">
                                    <label for="signoAnchoBobina" class="form-label">Signo Tolerancia</label>
                                    <!-- Este campo permite ingresar el signo de la tolerancia para el ancho de la bobina -->
                                    <input type="text" class="form-control" id="signoAnchoBobina">
                                </div>
                                <!-- Tolerancia del Ancho de Bobina (mm) -->
                                <div class="col-md-3">
                                    <label for="toleranciaAncho" class="form-label">Tolerancia Ancho de Bobina (mm)</label>
                                    <!-- Este campo permite ingresar el valor de la tolerancia en milímetros para el ancho de la bobina -->
                                    <input type="text" class="form-control" id="toleranciaAncho">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Peso de la Bobina (Kg) -->
                                <div class="col-md-6">
                                    <label for="pesoBobina" class="form-label">Peso de la Bobina (Kg)</label>
                                    <!-- Este campo permite ingresar el peso de la bobina en kilogramos -->
                                    <input type="number" class="form-control" id="pesoBobina">
                                </div>
                                <!-- Signo de Tolerancia para el Peso de la Bobina -->
                                <div class="col-md-3">
                                    <label for="signoPesoBobina" class="form-label">Signo Tolerancia</label>
                                    <!-- Este campo permite ingresar el signo de la tolerancia para el peso de la bobina -->
                                    <input type="text" class="form-control" id="signoPesoBobina">
                                </div>
                                <!-- Tolerancia del Peso de la Bobina (Kg) -->
                                <div class="col-md-3">
                                    <label for="toleranciaPeso" class="form-label">Tolerancia Peso de la Bobina (Kg)</label>
                                    <!-- Este campo permite ingresar el valor de la tolerancia en kilogramos para el peso de la bobina -->
                                    <input type="text" class="form-control" id="toleranciaPeso">
                                </div>
</div>


                            <!-- Embobinado -->
                            <h4 class="mt-5">Embobinado</h4>
                            <div class="row mb-6">
                                <div class="col-md-3">
                                    <label for="numEmbobinado" class="form-label">Número de Embobinado</label>
                                    <select class="form-select" id="numEmbobinado">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="sentidoEmbobinado" class="form-label">Sentido Embobinado</label>
                                    <select class="form-select" id="sentidoEmbobinado">
                                        <option value="dentro">Impresión por dentro</option>
                                        <option value="fuera">Impresión por fuera</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tacas y Fotoceldas -->
                            <h4 class="mt-5">Tacas y Fotoceldas</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="distanciaTacas" class="form-label">Distancia entre Tacas o Fotodistancia
                                        (mm)</label>
                                    <input type="number" class="form-control" id="distanciaTacas">
                                </div>
                                <div class="col-md-3">
                                    <label for="signoDistanciaTacas" class="form-label">Signo Tolerancia</label>
                                    <input type="text" class="form-control" id="signoDistanciaTacas">
                                </div>
                                <div class="col-md-3">
                                    <label for="toleranciaTacas" class="form-label">Tolerancia Distancia entre Tacas
                                        (mm)</label>
                                    <input type="text" class="form-control" id="toleranciaTacas">
                                </div>
                            </div>

                            <!-- Fotocelda 1 -->
                            <h5 class="mt-4">Fotocelda 1</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="distanciaFotocelda1" class="form-label">Distancia Fotocelda 1 al borde
                                        más cercano (mm)</label>
                                    <input type="number" class="form-control" id="distanciaFotocelda1">
                                </div>
                                <div class="col-md-3">
                                    <label for="fotocelda1Ancho" class="form-label">Fotocelda 1 Ancho (mm)</label>
                                    <input type="number" class="form-control" id="fotocelda1Ancho">
                                </div>
                                <div class="col-md-3">
                                    <label for="fotocelda1Alto" class="form-label">Fotocelda 1 Alto (mm)</label>
                                    <input type="number" class="form-control" id="fotocelda1Alto">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="posicionFotocelda1" class="form-label">Posición Fotocelda 1</label>
                                    <select class="form-select" id="posicionFotocelda1">
                                        <option value="izquierda">Izquierda</option>
                                        <option value="derecha">Derecha</option>
                                        <option value="centro">Centro</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Fotocelda 2 -->
                            <h5 class="mt-4">Fotocelda 2</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="distanciaFotocelda2" class="form-label">Distancia Fotocelda 2 al borde
                                        más cercano (mm)</label>
                                    <input type="number" class="form-control" id="distanciaFotocelda2">
                                </div>
                                <div class="col-md-3">
                                    <label for="fotocelda2Ancho" class="form-label">Fotocelda 2 Ancho (mm)</label>
                                    <input type="number" class="form-control" id="fotocelda2Ancho">
                                </div>
                                <div class="col-md-3">
                                    <label for="fotocelda2Alto" class="form-label">Fotocelda 2 Alto (mm)</label>
                                    <input type="number" class="form-control" id="fotocelda2Alto">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="posicionFotocelda2" class="form-label">Posición Fotocelda 2</label>
                                    <select class="form-select" id="posicionFotocelda2">
                                        <option value="izquierda">Izquierda</option>
                                        <option value="derecha">Derecha</option>
                                        <option value="centro">Centro</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
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