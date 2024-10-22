<?php
session_start();
require 'db_connection.php';

// Verificar si se ha enviado el formulario a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_formulario = $_POST['id_formulario'] ?? '';
    $solicitante = $_POST['solicitante'] ?? '';
    $id_user = $_POST['id_user'] ?? '';
    $cliente = $_POST['cliente'] ?? '';
    $nombre_proyecto = $_POST['nombre_proyecto'] ?? '';
    $estatus = $_POST['estatus'] ?? '';
    $numero_rfq = $_POST['numero_rfq'] ?? '';
    $formato_entrega = $_POST['formato_entrega'] ?? '';
    $formato_empaque = $_POST['formato_empaque'] ?? '';
    $elemento_conveniencia = $_POST['elemento_conveniencia'] ?? '';
    $proceso_llenado = $_POST['proceso_llenado'] ?? '';
    $sistema_empaque = $_POST['sistema_empaque'] ?? '';
    $unidad_venta = $_POST['unidad_venta'] ?? '';
    $volumen_pedido = $_POST['volumen_pedido'] ?? 0;
    $volumen_anual = $_POST['volumen_anual'] ?? 0;
    $sistema_impresion = $_POST['sistema_impresion'] ?? '';
    $numero_colores = $_POST['numero_colores'] ?? 0;
    $ancho = $_POST['ancho'] ?? 0;
    $tolerancia_ancho = $_POST['tolerancia_ancho'] ?? 0;
    $fotodistancias = $_POST['fotodistancias'] ?? null;
    $tolerancia_fotodistancias = $_POST['tolerancia_fotodistancias'] ?? null;
    $calibre = $_POST['calibre'] ?? '';
    $tolerancia_calibre = $_POST['tolerancia_calibre'] ?? '';
    $peso = $_POST['peso'] ?? '';
    $tolerancia_peso = $_POST['tolerancia_peso'] ?? '';
    $largo = $_POST['largo'] ?? '';
    $tolerancia_largo = $_POST['tolerancia_largo'] ?? '';
    $fuelle = $_POST['fuelle'] ?? '';
    $tolerancia_fuelle = $_POST['tolerancia_fuelle'] ?? '';
    $traslape = $_POST['traslape'] ?? '';
    $tolerancia_traslape = $_POST['tolerancia_traslape'] ?? '';
    $codigo_sostenibilidad = $_POST['codigo_sostenibilidad'] ?? '';
    $ficha_tecnica = isset($_POST['ficha_tecnica']) ? 1 : 0;
    $muestra_fisica = isset($_POST['muestra_fisica']) ? 1 : 0;
    $plano_mecanico = isset($_POST['plano_mecanico']) ? 1 : 0;
    $pdf_art = isset($_POST['pdf_arte']) ? 1 : 0;
    $es_bolsa = $_POST['es_bolsa'] ?? 'No';

    // Validar que los campos obligatorios estén presentes
    if (empty($id_formulario) || empty($solicitante) || empty($id_user) || empty($cliente) || empty($nombre_proyecto) || empty($numero_rfq) || empty($formato_entrega)) {
        echo "Todos los campos obligatorios deben ser completados.";
        exit;
    }

    // Preparar la declaración SQL para actualizar el formulario
    $sql = "
        UPDATE form1
        SET
            name_user = ?, 
            name_client = ?, 
            project_name = ?, 
            status_form1 = ?, 
            rfq_number = ?, 
            delivery_format = ?,
            packaging_format = ?,
            convenience_element_of_packaging = ?, 
            filling_process = ?, 
            packaging_system = ?, 
            sales_unit = ?, 
            volume_per_order = ?,
            annual_volume = ?, 
            printing_system = ?,
            number_of_colors = ?,
            width_mm = ?, 
            width_tolerance_mm = ?, 
            photo_distances_mm = ?, 
            photo_distances_tolerance_mm = ?, 
            thickness_microns = ?,
            thickness_tolerance_microns = ?, 
            weight_gm2 = ?, 
            weight_tolerance_gm2 = ?,
            length_mm = ?,
            length_tolerance_mm = ?,
            gusset_mm = ?,
            gusset_tolerance_mm = ?,
            overlap_mm = ?, 
            overlap_tolerance_mm = ?, 
            sustainability_code = ?,
            technical_sheet = ?, 
            physical_sample = ?, 
            mechanical_plan = ?, 
            pdf_art = ?,
            bag_check = ?
        WHERE 
            id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);

    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssiiisiddddddddddddddiiiiisi", // Tipos de parámetros: 's' para string y 'i' para entero
        $solicitante, 
        $cliente, 
        $nombre_proyecto, 
        $estatus, 
        $numero_rfq, 
        $formato_entrega,
        $formato_empaque, 
        $elemento_conveniencia,
        $proceso_llenado, 
        $sistema_empaque,
        $unidad_venta, 
        $volumen_pedido,
        $volumen_anual, 
        $sistema_impresion,
        $numero_colores,
        $ancho, 
        $tolerancia_ancho, 
        $fotodistancias,
        $tolerancia_fotodistancias,
        $calibre,
        $tolerancia_calibre, 
        $peso,
        $tolerancia_peso, 
        $largo, 
        $tolerancia_largo, 
        $fuelle, 
        $tolerancia_fuelle, 
        $traslape, 
        $tolerancia_traslape, 
        $codigo_sostenibilidad, 
        $ficha_tecnica, 
        $muestra_fisica, 
        $plano_mecanico,
        $pdf_art,
        $es_bolsa,
        $id_formulario
        
    );

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        // Redirigir al usuario a la lista de formularios después de una actualización exitosa
        header("Location: ../html/forms/form1_list.php");
        exit;
    } else {
        // Manejar el error en caso de fallo
        echo "Error al actualizar el formulario: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Solicitud inválida.";
}
?>
