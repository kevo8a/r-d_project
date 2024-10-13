<?php
session_start();
require '../php/db_connection.php';

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $cliente = $_POST['cliente'];
    $solicitante = $_POST['solicitante'];
    $id_user = $_POST['id_user'];
    $estatus = $_POST['estatus'];
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $numero_rfq = $_POST['numero_rfq'];
    $formato_entrega = $_POST['formato_entrega'];
    $formato_empaque = $_POST['formato_empaque'];
    $elemento_conveniencia = $_POST['elemento_conveniencia'];
    $proceso_llenado = $_POST['proceso_llenado'];
    $sistema_empaque = $_POST['sistema_empaque'];
    $unidad_venta = $_POST['unidad_venta'];
    $volumen_pedido = $_POST['volumen_pedido'];
    $volumen_anual = $_POST['volumen_anual'];
    $sistema_impresion = $_POST['sistema_impresion'];
    $numero_colores = $_POST['numero_colores'];
    $ancho = $_POST['ancho'];
    $tolerancia_ancho = $_POST['tolerancia_ancho'];
    $fotodistancias = $_POST['fotodistancias'] ?? null; // Si está vacio es null
    $tolerancia_fotodistancias = $_POST['tolerancia_fotodistancias'] ?? null;
    $largo = $_POST['largo'];
    $tolerancia_largo = $_POST['tolerancia_largo'];
    $fuelle = $_POST['fuelle'];
    $tolerancia_fuelle = $_POST['tolerancia_fuelle'];
    $traslape = $_POST['traslape'];
    $tolerancia_traslape = $_POST['tolerancia_traslape'];
    $codigo_sostenibilidad = $_POST['codigo_sostenibilidad'] ?? null;
    $ficha_tecnica = isset($_POST['ficha_tecnica']) ? 1 : 0; // 1 para Sí, 0 para No
    $muestra_fisica = isset($_POST['muestra_fisica']) ? 1 : 0;
    $plano_mecanico = isset($_POST['plano_mecanico']) ? 1 : 0;
    $pdf_arte = isset($_POST['pdf_arte']) ? 1 : 0;

    // Generar un id_form1 único (puedes ajustar esto según tus necesidades)
    $id_form1 = uniqid('form1_');

    // Preparar y vincular la declaración SQL
    $stmt = $conn->prepare("
        INSERT INTO form1 (
            id_form1, status_form1, id_user, name_user, name_client, project_name,
            rfq_number, delivery_format, packaging_format, convenience_element_of_packaging,
            filling_process, packaging_system, sales_unit, volume_per_order,
            annual_volume, printing_system, number_of_colors, width_mm,
            width_tolerance_mm, photo_distances_mm,
            photo_distances_tolerance_mm, thickness_microns, thickness_tolerance_microns,
            weight_gm2, weight_tolerance_gm2, length_mm, length_tolerance_mm,
            gusset_mm, gusset_tolerance_mm, overlap_mm, overlap_tolerance_mm,
            sustainability_code, technical_sheet, physical_sample,
            mechanical_plan, mechanical_plan_sheet
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    // Vincular parámetros
    $stmt->bind_param("ssissssssssssiifffifffifiiiii", 
        $id_form1, $estatus, $id_user, $solicitante, $cliente, 
        $nombre_proyecto, $numero_rfq, $formato_entrega, $formato_empaque,
        $elemento_conveniencia, $proceso_llenado, $sistema_empaque,
        $unidad_venta, $volumen_pedido, $volumen_anual, $sistema_impresion,
        $numero_colores, $ancho, $tolerancia_ancho,
        $fotodistancias, $tolerancia_fotodistancias, $largo,
        $tolerancia_largo, $fuelle, $tolerancia_fuelle, $traslape,
        $tolerancia_traslape, $codigo_sostenibilidad, $ficha_tecnica,
        $muestra_fisica, $plano_mecanico, $pdf_arte
    );

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
