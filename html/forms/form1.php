<?php
include '../../php/db_connection.php';
include '../../php/auth.php';
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
    <script src="../js/js.js"></script>
    <link href="../../css/sb-admin-2.css" rel="stylesheet">

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

                <!-- Topbar -->
                <?php include '../structure/navbar.php'; ?>

                <!-- Main Content -->
                <div class="container">
                    <h1 class="text-center mb-4">Formulario de Cotización</h1>
                    <form action="../../php/send_form1.php" method="POST">
                        <div class="row">
                            <!-- Cliente -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" id="cliente" name="cliente" required>
                                        <option value="" disabled selected>Selecciona un cliente</option>

                                        <?php
                                        // Habilitar la visualización de errores
                                        error_reporting(E_ALL);
                                        ini_set('display_errors', 1);

                                        // Incluir el archivo de conexión a la base de datos
                                        require '../../php/db_connection.php';

                                        // Intentar obtener los clientes
                                        $sql = "SELECT name FROM client";
                                        $result = mysqli_query($conn, $sql);

                                        // Verificar si la consulta fue exitosa
                                        if (!$result) {
                                            echo '<option value="" disabled>Error en la consulta: ' . mysqli_error($conn) . '</option>';
                                        } else {
                                            // Comprobar si hay resultados
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="" disabled>No se encontraron clientes</option>';
                                            }
                                        }

                                        // Cerrar la conexión
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
                                        value="<?php echo htmlspecialchars($name).' '. htmlspecialchars($last_name); ?>"
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
                                        required>
                                </div>
                            </div>
                            <!-- estatus -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="estatus" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus"
                                        value="En proceso" readonly>
                                </div>
                            </div>
                            <!-- folio -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio" readonly>
                                </div>
                            </div>
                            <!-- Numero de RFQ -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_rfq" class="form-label">Número de RFQ</label>
                                    <input type="number" class="form-control" id="numero_rfq" name="numero_rfq"
                                        required>
                                </div>
                            </div>

                            <!-- Formato de Entrega -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_entrega" class="form-label">Formato de Entrega</label>
                                    <select class="form-select" id="formato_entrega" name="formato_entrega" required>
                                        <option value="Rollo/Bobina">Rollo/Bobina</option>
                                        <option value="Sachet">Sachet</option>
                                        <option value="Bolsa Preformada">Bolsa Preformada</option>
                                        <option value="Tubular">Tubular</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Formato de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_empaque" class="form-label">Formato del Empaque</label>
                                    <select class="form-select" id="formato_empaque" name="formato_empaque" required>
                                        <option value="Doypack">Doypack</option>
                                        <option value="Pillow">Pillow</option>
                                        <option value="Envolvedora">Envolvedora</option>
                                        <option value="ColdSeal">ColdSeal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Elemento de Conveniencia -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="elemento_conveniencia" class="form-label">Elemento de Conveniencia del
                                        Empaque</label>
                                    <select class="form-select" id="elemento_conveniencia" name="elemento_conveniencia"
                                        required>
                                        <option value="Válvula">Válvula</option>
                                        <option value="Zipper">Zipper</option>
                                        <option value="Easy Open">Easy Open</option>
                                        <option value="Corte Laser">Corte Laser</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Proceso de Llenado -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="proceso_llenado" class="form-label">Proceso de Llenado</label>
                                    <select class="form-select" id="proceso_llenado" name="proceso_llenado" required>
                                        <option value="UHT">UHT</option>
                                        <option value="Pasteurizado">Pasteurizado</option>
                                        <option value="Flow pack">Flow pack</option>
                                        <option value="Choque Térmico">Choque Térmico</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Sistema de Empaque -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_empaque" class="form-label">Sistema de Empaque</label>
                                    <select class="form-select" id="sistema_empaque" name="sistema_empaque" required>
                                        <option value="Cuello Formador">Cuello Formador</option>
                                        <option value="Horizontal de Sachet">Horizontal de Sachet</option>
                                        <option value="Vertical Sachet">Vertical Sachet</option>
                                        <option value="Doypack">Doypack</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Unidad de Venta -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unidad_venta" class="form-label">Unidad de Venta</label>
                                    <select class="form-select" id="unidad_venta" name="unidad_venta" required>
                                        <option value="Unidades">Unidades</option>
                                        <option value="Kilogramos (KG)">Kilogramos (KG)</option>
                                        <option value="Metros">Metros</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Volumen por Pedido -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_pedido" class="form-label">Volumen por Pedido</label>
                                    <input type="number" class="form-control" id="volumen_pedido" name="volumen_pedido"
                                        required>
                                </div>
                            </div>
                            <!-- Volumen Anual -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="volumen_anual" class="form-label">Volumen Anual</label>
                                    <input type="number" class="form-control" id="volumen_anual" name="volumen_anual"
                                        required>
                                </div>
                            </div>
                            <!-- Sistema de Impresión -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sistema_impresion" class="form-label">Sistema de Impresión</label>
                                    <select class="form-select" id="sistema_impresion" name="sistema_impresion"
                                        required>
                                        <option value="Rotograbado">Rotograbado</option>
                                        <option value="Flexografía">Flexografía</option>
                                        <option value="Sin impresión">Sin impresión</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Numero de Colores -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_colores" class="form-label">Número de Colores</label>
                                    <input type="number" class="form-control" id="numero_colores" name="numero_colores"
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
                                    <input type="number" class="form-control" id="ancho" name="ancho" step="any"
                                        required>
                                </div>
                            </div>

                            <!-- Tolerancia de ancho -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_ancho" class="form-label">Tolerancia Ancho (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_ancho" step="any"
                                        name="tolerancia_ancho" required>
                                </div>
                            </div>
                            <!-- Check Diseño Continuo -->
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="check_diseno_continuo"
                                        name="check_diseno_continuo" onchange="toggleFotodistancias()">
                                    <label class="form-check-label" for="check_diseno_continuo">Diseño Continuo</label>
                                </div>
                            </div>
                            <!-- Fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="fotodistancias" class="form-label">Fotodistancias (mm)</label>
                                    <input type="number" class="form-control" id="fotodistancias" name="fotodistancias"
                                        step="any">
                                </div>
                            </div>
                            <!-- Tolerancia de fotodistancias -->
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="tolerancia_fotodistancias" class="form-label">Tolerancia Fotodistancias
                                        (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fotodistancias"
                                        name="tolerancia_fotodistancias" step="any">
                                </div>
                            </div>
                            <!-- Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="calibre" class="form-label">Calibre (micras))</label>
                                    <input type="number" class="form-control" id="calibre" name="calibre" step="any">
                                </div>
                            </div>
                            <!-- Tolerancia Calibre (micras) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_calibre" class="form-label">Tolerancia Calibre
                                        (micras)</label>
                                    <input type="number" class="form-control" id="tolerancia_calibre"
                                        name="tolerancia_calibre" step="any">
                                </div>
                            </div>
                            <!-- Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peso" class="form-label">Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="peso" name="peso" step="any">
                                </div>
                            </div>
                            <!-- Tolerancia Peso (gm-2) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tolerancia_peso" class="form-label">Tolerancia Peso (gm-2)</label>
                                    <input type="number" class="form-control" id="tolerancia_peso" step="any"
                                        name="tolerancia_peso">
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
                            <!-- Dimensiones de la Bolsa -->
                            <div class="col-md-1">
                                <div class="mb-1">
                                    <label for="es_bolsa" class="form-label">¿Es Bolsa?</label>
                                    <select class="form-select" id="es_bolsa" name="es_bolsa"
                                        onchange="toggleDimensionesBolsa()" required>
                                        <option value="Sí">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="largo" class="form-label">Largo (mm)</label>
                                    <input type="number" class="form-control" id="largo" name="largo" step="any"
                                        required>
                                </div>
                            </div>

                            <!-- Tolerancia largo -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_largo" class="form-label">Tolerancia Largo (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_largo"
                                        name="tolerancia_largo" step="any" required>
                                </div>
                            </div>

                            <!-- Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="fuelle" class="form-label">Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="fuelle" name="fuelle" step="any"
                                        required>
                                </div>
                            </div>

                            <!-- Tolerancia Fuelle -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_fuelle" class="form-label">Tolerancia Fuelle (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_fuelle"
                                        name="tolerancia_fuelle" step="any" required>
                                </div>
                            </div>

                            <!-- Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="traslape" class="form-label">Traslape (mm)</label>
                                    <input type="number" class="form-control" id="traslape" name="traslape" step="any"
                                        required>
                                </div>
                            </div>

                            <!-- Tolerancia Traslape -->
                            <div class="col-md-6 bolsa_fields">
                                <div class="mb-3">
                                    <label for="tolerancia_traslape" class="form-label">Tolerancia Traslape (mm)</label>
                                    <input type="number" class="form-control" id="tolerancia_traslape"
                                        name="tolerancia_traslape" step="any" required>
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
                                        name="codigo_sostenibilidad" disabled>
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
                                        name="ficha_tecnica">
                                    <label class="form-check-label" for="ficha_tecnica">Ficha Técnica</label>
                                </div>
                            </div>

                            <!-- Muestra Física -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="muestra_fisica"
                                        name="muestra_fisica">
                                    <label class="form-check-label" for="muestra_fisica">Muestra Física</label>
                                </div>
                            </div>

                            <!-- Plano Mecánico -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="plano_mecanico"
                                        name="plano_mecanico">
                                    <label class="form-check-label" for="plano_mecanico">Plano Mecánico</label>
                                </div>
                            </div>

                            <!-- PDF Arte -->
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="pdf_arte" name="pdf_arte">
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
                                    <button type="submit" class="btn btn-primary">Enviar Cotización</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>