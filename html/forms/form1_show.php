<?php
// Incluir la autenticación
require '../../php/db_connection.php';
require '../../php/auth.php';

// Obtener el id del formulario de la URL
if (!isset($_GET['id'])) {
    die('ID del formulario no proporcionado.');
}

$id_formulario = $_GET['id'];

// Consultar los datos del formulario por su ID
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

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../structure/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../structure/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container">
                    <h1 class="text-center mb-4">Editar Formulario de Cotización</h1>
                    <form>
                        <input type="hidden" name="id_formulario"
                            value="<?php echo htmlspecialchars($id_formulario); ?>">
                        <div class="row">

                            <!-- Cliente -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" id="cliente" name="cliente" disabled>
                                        <option value="" disabled>Selecciona un cliente</option>
                                        <?php
                                        require '../../php/db_connection.php';

                                        $sql_clientes = "SELECT name FROM client";
                                        $result_clientes = mysqli_query($conn, $sql_clientes);

                                        if ($result_clientes) {
                                            while ($row_cliente = mysqli_fetch_assoc($result_clientes)) {
                                                $selected = ($row_cliente['name'] == $form_data['name_client']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($row_cliente['name']) . '" ' . $selected . '>' . htmlspecialchars($row_cliente['name']) . '</option>';
                                            }
                                        }

                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Solicitante -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="solicitante" class="form-label">Solicitante</label>
                                    <input type="text" class="form-control" id="solicitante" name="solicitante"
                                        value="<?php echo htmlspecialchars($name) . ' ' . htmlspecialchars($last_name); ?>"
                                        readonly>
                                </div>
                            </div>
                            <!-- ID Usuario -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user"
                                        value="<?php echo htmlspecialchars($user_id); ?>" readonly>
                                </div>
                            </div>

                            <!-- Nombre de proyecto -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto/Producto</label>
                                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                                        value="<?php echo htmlspecialchars($form_data['project_name']); ?>" readonly>
                                </div>
                            </div>

                            <!-- Estatus -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="estatus" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus"
                                        value="<?php echo htmlspecialchars($form_data['status_form1']); ?>" readonly>
                                </div>
                            </div>

                            <!-- folio -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio"
                                        value="<?php echo htmlspecialchars($form_data['id_form1']); ?>" readonly>
                                </div>
                            </div>

                            <!-- Número de RFQ -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_rfq" class="form-label">Número de RFQ</label>
                                    <input type="number" class="form-control" id="numero_rfq" name="numero_rfq"
                                        value="<?php echo htmlspecialchars($form_data['rfq_number']); ?>" readonly>
                                </div>
                            </div>

                            <!-- Formato de Entrega -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_entrega" class="form-label">Formato de Entrega</label>
                                    <select class="form-control" id="formato_entrega" name="formato_entrega" disabled>
                                        <option value="Rollo/Bobina"
                                            <?php echo ($form_data['delivery_format'] == 'Rollo/Bobina') ? 'selected' : ''; ?>>
                                            Rollo/Bobina</option>
                                        <option value="Sachet"
                                            <?php echo ($form_data['delivery_format'] == 'Sachet') ? 'selected' : ''; ?>>
                                            Sachet</option>
                                        <option value="Bolsa Preformada"
                                            <?php echo ($form_data['delivery_format'] == 'Bolsa Preformada') ? 'selected' : ''; ?>>
                                            Bolsa Preformada</option>
                                        <option value="Tubular"
                                            <?php echo ($form_data['delivery_format'] == 'Tubular') ? 'selected' : ''; ?>>
                                            Tubular</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Formato de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_empaque" class="form-label">Formato del Empaque</label>
                                    <select class="form-control" id="formato_empaque" name="formato_empaque" disabled>
                                        <option value="Doypack"
                                            <?php echo ($form_data['packaging_format'] == 'Doypack') ? 'selected' : ''; ?>>
                                            Doypack</option>
                                        <option value="Pillow"
                                            <?php echo ($form_data['packaging_format'] == 'Pillow') ? 'selected' : ''; ?>>
                                            Pillow</option>
                                        <option value="Envolvedora"
                                            <?php echo ($form_data['packaging_format'] == 'Envolvedora') ? 'selected' : ''; ?>>
                                            Envolvedora</option>
                                        <option value="ColdSeal"
                                            <?php echo ($form_data['packaging_format'] == 'ColdSeal') ? 'selected' : ''; ?>>
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
                                        disabled>
                                        <option value="Válvula"
                                            <?php echo ($form_data['convenience_element_of_packaging'] == 'Válvula') ? 'selected' : ''; ?>>
                                            Válvula</option>
                                        <option value="Zipper"
                                            <?php echo ($form_data['convenience_element_of_packaging'] == 'Zipper') ? 'selected' : ''; ?>>
                                            Zipper</option>
                                        <option value="Easy Open"
                                            <?php echo ($form_data['convenienceconvenience_element_of_packaging_element'] == 'Easy Open') ? 'selected' : ''; ?>>
                                            Easy Open</option>
                                        <option value="Corte Laser"
                                            <?php echo ($form_data['convenience_element_of_packaging'] == 'Corte Laser') ? 'selected' : ''; ?>>
                                            Corte Laser</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Proceso de Llenado -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="proceso_llenado" class="form-label">Proceso de Llenado</label>
                                    <select class="form-control" id="proceso_llenado" name="proceso_llenado" disabled>
                                        <option value="UHT"
                                            <?php echo ($form_data['filling_process'] == 'UHT') ? 'selected' : ''; ?>>
                                            UHT</option>
                                        <option value="Pasteurizado"
                                            <?php echo ($form_data['filling_process'] == 'Pasteurizado') ? 'selected' : ''; ?>>
                                            Pasteurizado</option>
                                        <option value="Flow pack"
                                            <?php echo ($form_data['filling_process'] == 'Flow pack') ? 'selected' : ''; ?>>
                                            Flow pack</option>
                                        <option value="Choque Térmico"
                                            <?php echo ($form_data['filling_process'] == 'Choque Térmico') ? 'selected' : ''; ?>>
                                            Choque Térmico</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sistema de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_empaque" class="form-label">Sistema de Empaque</label>
                                    <select class="form-control" id="sistema_empaque" name="sistema_empaque" disabled>
                                        <option value="Cuello Formador"
                                            <?php echo ($form_data['packaging_system'] == 'Cuello Formador') ? 'selected' : ''; ?>>
                                            Cuello Formador</option>
                                        <option value="Horizontal de Sachet"
                                            <?php echo ($form_data['packaging_system'] == 'Horizontal de Sachet') ? 'selected' : ''; ?>>
                                            Horizontal de Sachet</option>
                                        <option value="Vertical Sachet"
                                            <?php echo ($form_data['packaging_system'] == 'Vertical Sachet') ? 'selected' : ''; ?>>
                                            Vertical Sachet</option>
                                        <option value="Doypack"
                                            <?php echo ($form_data['packaging_system'] == 'Doypack') ? 'selected' : ''; ?>>
                                            Doypack</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Unidad de Venta -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unidad_venta" class="form-label">Unidad de Venta</label>
                                    <select class="form-control" id="unidad_venta" name="unidad_venta" disabled>
                                        <option value="Unidades"
                                            <?php echo ($form_data['sales_unit'] == 'Unidades') ? 'selected' : ''; ?>>
                                            Unidades</option>
                                        <option value="Kilogramos (KG)"
                                            <?php echo ($form_data['sales_unit'] == 'Kilogramos (KG)') ? 'selected' : ''; ?>>
                                            Kilogramos (KG)</option>
                                        <option value="Metros"
                                            <?php echo ($form_data['sales_unit'] == 'Metros') ? 'selected' : ''; ?>>
                                            Metros</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Volumen por Pedido -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_pedido" class="form-label">Volumen por Pedido</label>
                                    <input type="number" class="form-control" id="volumen_pedido" name="volumen_pedido"
                                        value="<?php echo htmlspecialchars($form_data['volume_per_order']); ?>"
                                        readonly />
                                </div>
                            </div>
                            <!-- Volumen Anual -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_anual" class="form-label">Volumen Anual</label>
                                    <input type="number" class="form-control" id="volumen_anual" name="volumen_anual"
                                        value="<?php echo htmlspecialchars($form_data['annual_volume']); ?>" readonly>
                                </div>
                            </div>

                            <!-- Sistema de Impresión -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_impresion" class="form-label">Sistema de Impresión</label>
                                    <select class="form-control" id="sistema_impresion" name="sistema_impresion"
                                        disabled>
                                        <option value="Rotograbado"
                                            <?php echo ($form_data['printing_system'] == 'Rotograbado') ? 'selected' : ''; ?>>
                                            Rotograbado</option>
                                        <option value="Flexografía"
                                            <?php echo ($form_data['printing_system'] == 'Flexografía') ? 'selected' : ''; ?>>
                                            Flexografía</option>
                                        <option value="Sin impresión"
                                            <?php echo ($form_data['printing_system'] == 'Sin impresión') ? 'selected' : ''; ?>>
                                            Sin impresión</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Número de Colores -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_colores" class="form-label">Número de Colores</label>
                                    <input type="number" class="form-control" id="numero_colores" name="numero_colores"
                                        value="<?php echo htmlspecialchars($form_data['number_of_colors']); ?>" required
                                        readonly>
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
                                        value="<?php echo htmlspecialchars($form_data['width_mm']); ?>" step="any"
                                        readonly required>
                                </div>
                            </div>

                            <!-- Tolerancia de ancho -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_ancho" class="form-label">Tolerancia Ancho (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_ancho"
                                        name="tolerancia_ancho"
                                        value="<?php echo htmlspecialchars($form_data['width_tolerance_mm']); ?>"
                                        step="any" readonly required>
                                </div>
                            </div>

                            <!-- Check Diseño Continuo -->
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="check_diseno_continuo"
                                        name="check_diseno_continuo"
                                        <?php echo ($form_data['continuous_design_check'] == 0 ? 'checked' : ''); ?>
                                        disabled>
                                    <label class="form-check-label" for="check_diseno_continuo">Diseño Continuo</label>
                                </div>
                            </div>

                            <!-- Fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="fotodistancias" class="form-label">Fotodistancias (mm)</label>
                                    <input type="number" class="form-control" id="fotodistancias" name="fotodistancias"
                                        value="<?php echo htmlspecialchars($form_data['photo_distances_mm']); ?>"
                                        step="any" readonly>
                                </div>
                            </div>

                            <!-- Tolerancia de fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="tolerancia_fotodistancias" class="form-label">Tolerancia Fotodistancias
                                        (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fotodistancias"
                                        name="tolerancia_fotodistancias"
                                        value="<?php echo htmlspecialchars($form_data['photo_distances_tolerance_mm']); ?>"
                                        step="any" readonly>
                                </div>
                            </div>

                            <!-- Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="calibre" class="form-label">Calibre (micras)</label>
                                    <input type="number" class="form-control" id="calibre" name="calibre"
                                        value="<?php echo htmlspecialchars($form_data['thickness_microns']); ?>"
                                        step="any" readonly>
                                </div>
                            </div>

                            <!-- Tolerancia Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_calibre" class="form-label">Tolerancia Calibre
                                        (micras)</label>
                                    <input type="number" class="form-control" id="tolerancia_calibre"
                                        name="tolerancia_calibre"
                                        value="<?php echo htmlspecialchars($form_data['thickness_tolerance_microns']); ?>"
                                        step="any" readonly>
                                </div>
                            </div>

                            <!-- Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peso" class="form-label">Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="peso" name="peso"
                                        value="<?php echo htmlspecialchars($form_data['weight_gm2']); ?>" step="any"
                                        readonly>
                                </div>
                            </div>

                            <!-- Tolerancia Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_peso" class="form-label">Tolerancia Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="tolerancia_peso"
                                        name="tolerancia_peso"
                                        value="<?php echo htmlspecialchars($form_data['weight_tolerance_gm2']); ?>"
                                        step="any" readonly>
                                </div>
                            </div>
                            <!-- Espacio -->
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-11 text-center">

                                <h3>
                                    <p></p>Dimensiones Bolsa
                                </h3>
                            </div>
                            <!-- Largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="largo" class="form-label">Largo (mm)</label>
                                    <input type="number" class="form-control" id="largo" name="largo"
                                        value="<?php echo htmlspecialchars($form_data['length_mm']); ?>" step="any"
                                        required readonly>
                                </div>
                            </div>

                            <!-- Tolerancia largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_largo" class="form-label">Tolerancia Largo (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_largo"
                                        name="tolerancia_largo"
                                        value="<?php echo htmlspecialchars($form_data['length_tolerance_mm']); ?>"
                                        step="any" required readonly>
                                </div>
                            </div>

                            <!-- Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="fuelle" class="form-label">Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="fuelle" name="fuelle"
                                        value="<?php echo htmlspecialchars($form_data['gusset_mm']); ?>" step="any"
                                        required readonly>
                                </div>
                            </div>

                            <!-- Tolerancia Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_fuelle" class="form-label">Tolerancia Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fuelle"
                                        name="tolerancia_fuelle"
                                        value="<?php echo htmlspecialchars($form_data['gusset_tolerance_mm']); ?>"
                                        step="any" required readonly>
                                </div>
                            </div>

                            <!-- Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="traslape" class="form-label">Traslape (mm)</label>
                                    <input type="number" class="form-control" id="traslape" name="traslape"
                                        value="<?php echo htmlspecialchars($form_data['overlap_mm']); ?>" step="any"
                                        required readonly>
                                </div>
                            </div>

                            <!-- Tolerancia Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_traslape" class="form-label">Tolerancia Traslape (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_traslape"
                                        name="tolerancia_traslape"
                                        value="<?php echo htmlspecialchars($form_data['overlap_tolerance_mm']); ?>"
                                        step="any" required readonly>
                                </div>
                            </div>

                            <!-- Check Código de sostenibilidad -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="check_sostenibilidad"
                                        name="check_sostenibilidad" onchange="toggleCodigoSostenibilidad()">
                                    <label class="form-check-label" for="check_sostenibilidad">Check código de
                                        sostenibilidad</label>
                                </div>
                            </div>

                            <!-- Código de sostenibilidad -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="codigo_sostenibilidad" class="form-label">Código de
                                        Sostenibilidad</label>
                                    <input type="text" class="form-control" id="codigo_sostenibilidad"
                                        name="codigo_sostenibilidad"
                                        value="<?php echo htmlspecialchars($form_data['sustainability_code']); ?>"
                                        readonly>
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
                                        <?php echo ($form_data['technical_sheet'] == 0 ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="ficha_tecnica">Ficha Técnica</label>
                                </div>
                            </div>

                            <!-- Muestra Física -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="muestra_fisica"
                                        name="muestra_fisica"
                                        <?php echo ($form_data['physical_sample'] == 0 ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="muestra_fisica">Muestra Física</label>
                                </div>
                            </div>

                            <!-- Plano Mecánico -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="plano_mecanico"
                                        name="plano_mecanico"
                                        <?php echo ($form_data['mechanical_plan'] == 0 ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="plano_mecanico">Plano Mecánico</label>
                                </div>
                            </div>

                            <!-- PDF Arte -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="pdf_arte" name="pdf_arte"
                                        <?php echo ($form_data['pdf_art'] == 0 ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="pdf_arte">PDF del Arte</label>
                                </div>
                            </div>

                            <!-- Alerta -->
                            <div class="col-md-12 text-center">
                                <div class="alert alert-warning w-100" role="alert">
                                    Es obligatorio adjuntar la ficha técnica o la muestra física.
                                </div>
                            </div>
                            <!-- Botón Enviar -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.history.back();">Volver</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>