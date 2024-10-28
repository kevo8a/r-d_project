<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener el ID del formulario de la URL (para editar)
$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];

// Si hay un ID, consultar los datos del formulario por su ID
if ($id_formulario) {
    $sql = "SELECT * FROM form1 WHERE id = ?";
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
    <title>Amcor - Formulario Cotización</title>

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
                        Cotización</h1>
                    <form id="form-cotizacion" method="POST">
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

                            <!-- Aprobado por -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="approved_by" class="form-label">Aprobado por</label>
                                    <input type="text" class="form-control" id="approved_by" name="approved_by"
                                        value="<?php echo isset($id_formulario) && $id_formulario ? htmlspecialchars($form_data['approved_by']) : ''; ?>"
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
                                        readonly>
                                </div>
                            </div>

                            <!-- Estatus -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="estatus" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['status_form1']) : 'En Proceso'; ?>"
                                        readonly>
                                </div>
                            </div>

                            <!-- folio -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['id_form1']): ''; ?>"
                                        readonly>
                                </div>
                            </div>

                            <!-- Cliente -->
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto/Producto</label>
                                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['project_name']) : ''; ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Número de RFQ -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    RFQ</label>
                                    <input type="number" class="form-control" id="numero_rfq" name="numero_rfq"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['rfq_number']): ''; ?>"
                                        required>
                                </div>
                            </div>


                            <!-- Formato de Entrega -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_entrega" class="form-label">Formato de Entrega</label>
                                    <select class="form-control" id="formato_entrega" name="formato_entrega" required>
                                        <option value="Rollo/Bobina"
                                            <?php echo ($id_formulario && $form_data['delivery_format'] == 'Rollo/Bobina') ? 'selected' : ''; ?>>
                                            Rollo/Bobina</option>
                                        <option value="Sachet"
                                            <?php echo ($id_formulario && $form_data['delivery_format'] == 'Sachet') ? 'selected' : ''; ?>>
                                            Sachet</option>
                                        <option value="Bolsa Preformada"
                                            <?php echo ($id_formulario && $form_data['delivery_format'] == 'Bolsa Preformada') ? 'selected' : ''; ?>>
                                            Bolsa Preformada</option>
                                        <option value="Tubular"
                                            <?php echo ($id_formulario && $form_data['delivery_format'] == 'Tubular') ? 'selected' : ''; ?>>
                                            Tubular</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Formato de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_empaque" class="form-label">Formato del Empaque</label>
                                    <select class="form-control" id="formato_empaque" name="formato_empaque" required>
                                        <option value="Doypack"
                                            <?php echo ($id_formulario && $form_data['packaging_format'] == 'Doypack') ? 'selected' : ''; ?>>
                                            Doypack</option>
                                        <option value="Pillow"
                                            <?php echo ($id_formulario && $form_data['packaging_format'] == 'Pillow') ? 'selected' : ''; ?>>
                                            Pillow</option>
                                        <option value="Envolvedora"
                                            <?php echo ($id_formulario && $form_data['packaging_format'] == 'Envolvedora') ? 'selected' : ''; ?>>
                                            Envolvedora</option>
                                        <option value="ColdSeal"
                                            <?php echo ($id_formulario && $form_data['packaging_format'] == 'ColdSeal') ? 'selected' : ''; ?>>
                                            ColdSeal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Elemento de Conveniencia -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="elemento_conveniencia" class="form-label">Elemento de Conveniencia del
                                        Empaque</label>
                                    <select class="form-control" id="elemento_conveniencia" name="elemento_conveniencia"
                                        required>
                                        <option value="Válvula"
                                            <?php echo ($id_formulario && $form_data['convenience_element_of_packaging'] == 'Válvula') ? 'selected' : ''; ?>>
                                            Válvula</option>
                                        <option value="Zipper"
                                            <?php echo ($id_formulario && $form_data['convenience_element_of_packaging'] == 'Zipper') ? 'selected' : ''; ?>>
                                            Zipper</option>
                                        <option value="Easy Open"
                                            <?php echo ($id_formulario && $form_data['convenience_element_of_packaging'] == 'Easy Open') ? 'selected' : ''; ?>>
                                            Easy Open</option>
                                        <option value="Corte Laser"
                                            <?php echo ($id_formulario && $form_data['convenience_element_of_packaging'] == 'Corte Laser') ? 'selected' : ''; ?>>
                                            Corte Laser</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Proceso de Llenado -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="proceso_llenado" class="form-label">Proceso de Llenado</label>
                                    <select class="form-control" id="proceso_llenado" name="proceso_llenado" required>
                                        <option value="UHT"
                                            <?php echo ($id_formulario && $form_data['filling_process'] == 'UHT') ? 'selected' : ''; ?>>
                                            UHT</option>
                                        <option value="Pasteurizado"
                                            <?php echo ($id_formulario && $form_data['filling_process'] == 'Pasteurizado') ? 'selected' : ''; ?>>
                                            Pasteurizado</option>
                                        <option value="Flow pack"
                                            <?php echo ($id_formulario && $form_data['filling_process'] == 'Flow pack') ? 'selected' : ''; ?>>
                                            Flow pack</option>
                                        <option value="Choque Térmico"
                                            <?php echo ($id_formulario && $form_data['filling_process'] == 'Choque Térmico') ? 'selected' : ''; ?>>
                                            Choque Térmico</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sistema de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_empaque" class="form-label">Sistema de Empaque</label>
                                    <select class="form-control" id="sistema_empaque" name="sistema_empaque" required>
                                        <option value="Cuello Formador"
                                            <?php echo ($id_formulario && $form_data['packaging_system'] == 'Cuello Formador') ? 'selected' : ''; ?>>
                                            Cuello Formador</option>
                                        <option value="Horizontal de Sachet"
                                            <?php echo ($id_formulario && $form_data['packaging_system'] == 'Horizontal de Sachet') ? 'selected' : ''; ?>>
                                            Horizontal de Sachet</option>
                                        <option value="Vertical Sachet"
                                            <?php echo ($id_formulario && $form_data['packaging_system'] == 'Vertical Sachet') ? 'selected' : ''; ?>>
                                            Vertical Sachet</option>
                                        <option value="Doypack"
                                            <?php echo ($id_formulario && $form_data['packaging_system'] == 'Doypack') ? 'selected' : ''; ?>>
                                            Doypack</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Unidad de Venta -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unidad_venta" class="form-label">Unidad de Venta</label>
                                    <select class="form-control" id="unidad_venta" name="unidad_venta" required>
                                        <option value="Unidades"
                                            <?php echo ($id_formulario && $form_data['sales_unit'] == 'Unidades') ? 'selected' : ''; ?>>
                                            Unidades</option>
                                        <option value="Kilogramos (KG)"
                                            <?php echo ($id_formulario && $form_data['sales_unit'] == 'Kilogramos (KG)') ? 'selected' : ''; ?>>
                                            Kilogramos (KG)</option>
                                        <option value="Metros"
                                            <?php echo ($id_formulario && $form_data['sales_unit'] == 'Metros') ? 'selected' : ''; ?>>
                                            Metros</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Volumen por Pedido -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_pedido" class="form-label">Volumen por Pedido</label>
                                    <input type="number" class="form-control" id="volumen_pedido" name="volumen_pedido"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['volume_per_order']) : ''; ?>"
                                        required />
                                </div>
                            </div>

                            <!-- Volumen Anual -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_anual" class="form-label">Volumen Anual</label>
                                    <input type="number" class="form-control" id="volumen_anual" name="volumen_anual"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['annual_volume']) : ''; ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Sistema de Impresión -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_impresion" class="form-label">Sistema de Impresión</label>
                                    <select class="form-control" id="sistema_impresion" name="sistema_impresion"
                                        required>
                                        <option value="Rotograbado"
                                            <?php echo ($id_formulario && $form_data['printing_system'] == 'Rotograbado') ? 'selected' : ''; ?>>
                                            Rotograbado</option>
                                        <option value="Flexografía"
                                            <?php echo ($id_formulario && $form_data['printing_system'] == 'Flexografía') ? 'selected' : ''; ?>>
                                            Flexografía</option>
                                        <option value="Sin impresión"
                                            <?php echo ($id_formulario && $form_data['printing_system'] == 'Sin impresión') ? 'selected' : ''; ?>>
                                            Sin impresión</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Número de Colores -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_colores" class="form-label">Número de Colores</label>
                                    <input type="number" class="form-control" id="numero_colores" name="numero_colores"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['number_of_colors']) : ''; ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Dimensiones -->
                            <div class="col-md-12 text-center">
                                <h3>Dimensiones</h3>
                            </div>

                            <!-- Ancho -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ancho" class="form-label">Ancho (mm)</label>
                                    <input type="number" class="form-control" id="ancho" name="ancho"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['width_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia de Ancho -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_ancho" class="form-label">Tolerancia Ancho (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_ancho"
                                        name="tolerancia_ancho"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['width_tolerance_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Check Diseño Continuo -->
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="continuous_check"
                                        name="continuous_check" onchange="toggleFotodistancias()"
                                        <?php echo ($id_formulario && $form_data['continuous_check'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="continuous_check">Diseño
                                        Continuo</label>
                                </div>
                            </div>

                            <!-- Fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="fotodistancias" class="form-label">Fotodistancias (mm)</label>
                                    <input type="number" class="form-control" id="fotodistancias" name="fotodistancias"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['photo_distances_mm']) : ''; ?>"
                                        step="any">
                                </div>
                            </div>

                            <!-- Tolerancia de Fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="tolerancia_fotodistancias" class="form-label">Tolerancia Fotodistancias
                                        (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fotodistancias"
                                        name="tolerancia_fotodistancias"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['photo_distances_tolerance_mm']) : ''; ?>"
                                        step="any">
                                </div>
                            </div>

                            <!-- Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="calibre" class="form-label">Calibre (micras)</label>
                                    <input type="number" class="form-control" id="calibre" name="calibre"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['thickness_microns']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_calibre" class="form-label">Tolerancia Calibre
                                        (micras)</label>
                                    <input type="number" class="form-control" id="tolerancia_calibre"
                                        name="tolerancia_calibre"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['thickness_tolerance_microns']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peso" class="form-label">Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="peso" name="peso"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['weight_gm2']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_peso" class="form-label">Tolerancia Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="tolerancia_peso"
                                        name="tolerancia_peso"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['weight_tolerance_gm2']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Espacio -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                </div>
                            </div>

                            <!-- ¿Es Bolsa? -->
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <label for="es_bolsa" class="form-label">¿Es Bolsa?</label>
                                    <input type="checkbox" id="es_bolsa" name="es_bolsa" value="1"
                                        <?php echo ($id_formulario && $form_data['bag_check'] == 1 ? 'checked' : ''); ?>>
                                    <label for="es_bolsa">Sí</label>
                                </div>
                            </div>

                            <!-- Dimensiones de la Bolsa -->
                            <div class="col-md-6"></div>
                            <div class="col-md-12 text-center bolsa_fields">
                                <h3>Dimensiones Bolsa</h3>
                            </div>

                            <!-- Largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="largo" class="form-label">Largo (mm)</label>
                                    <input type="number" class="form-control" id="largo" name="largo"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['length_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_largo" class="form-label">Tolerancia Largo (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_largo"
                                        name="tolerancia_largo"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['length_tolerance_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="fuelle" class="form-label">Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="fuelle" name="fuelle"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['gusset_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_fuelle" class="form-label">Tolerancia Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fuelle"
                                        name="tolerancia_fuelle"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['gusset_tolerance_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="traslape" class="form-label">Traslape (mm)</label>
                                    <input type="number" class="form-control" id="traslape" name="traslape"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['overlap_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Tolerancia Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_traslape" class="form-label">Tolerancia Traslape (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_traslape"
                                        name="tolerancia_traslape"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['overlap_tolerance_mm']) : ''; ?>"
                                        step="any" required>
                                </div>
                            </div>

                            <!-- Check Código de sostenibilidad -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="sustainability_check"
                                        name="sustainability_check"
                                        <?php echo ($id_formulario && $form_data['sustainability_check'] == 1 ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="sustainability_check">Check código de
                                        sostenibilidad</label>
                                </div>
                            </div>

                            <!-- Campo de Código de sostenibilidad -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="codigo_sostenibilidad"
                                        name="codigo_sostenibilidad"
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['sustainability_code']) : ''; ?>">
                                </div>
                            </div>

                            <!-- Adjuntos -->
                            <div class="col-md-12 text-center">
                                <h3>Check de Adjuntos</h3>
                            </div>

                            <!-- Ficha Técnica -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="ficha_tecnica"
                                        name="ficha_tecnica"
                                        <?php echo ($id_formulario && $form_data['technical_sheet'] == 1 ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="ficha_tecnica">Ficha Técnica</label>
                                </div>
                            </div>

                            <!-- Muestra Física -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="muestra_fisica"
                                        name="muestra_fisica"
                                        <?php echo ($id_formulario && $form_data['physical_sample'] == 1 ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="muestra_fisica">Muestra Física</label>
                                </div>
                            </div>

                            <!-- Plano Mecánico -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="plano_mecanico"
                                        name="plano_mecanico"
                                        <?php echo ($id_formulario && $form_data['mechanical_plan'] == 1 ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="plano_mecanico">Plano Mecánico</label>
                                </div>
                            </div>

                            <!-- PDF Arte -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="pdf_arte" name="pdf_arte"
                                        <?php echo ($id_formulario && $form_data['pdf_art'] == 1 ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="pdf_arte">PDF del Arte</label>
                                </div>
                            </div>

                            <!-- Alerta -->
                            <div class="col-md-12 text-center">
                                <div class="alert alert-warning w-100" role="alert">
                                    Es obligatorio adjuntar la ficha técnica o la muestra física.
                                </div>
                            </div>
                            <!-- Botón de Envío -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        <?php echo $id_formulario ? 'Actualizar' : 'Crear'; ?> Cotización
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
<script>
$(document).ready(function() {
    $('#submit-btn').click(function(event) {
        event.preventDefault(); // Evita el envío predeterminado del formulario

        // Captura los datos del formulario
        var formData = $('#form-cotizacion').serialize();

        // Realiza la solicitud AJAX
        $.ajax({
            url: '../../php/<?php echo isset($id_formulario) ? 'update_form1.php' : 'send_form1.php'; ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Verifica el contenido de la respuesta y actúa en consecuencia
                if (response.trim() === 'success') {
                    alert('Formulario guardado con éxito.');
                    // Redireccionar a la página de lista de formularios u otra acción
                    window.history.back();
                } else if (response.trim() === 'incomplete') {
                    alert('Por favor, complete todos los campos obligatorios.');
                } else {
                    // Mostrar el mensaje de error devuelto por PHP
                    alert('Error: ' + response);
                }
            },
            error: function() {
                // Muestra una alerta de error si hay algún problema con la solicitud
                alert('Hubo un error al procesar la solicitud. Intenta de nuevo.');
            }
        });
    });
});
</script>