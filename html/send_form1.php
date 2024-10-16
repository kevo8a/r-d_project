<?php   
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_form1 = uniqid('form1_');
    $solicitante = $_POST['solicitante'] ?? '';
    $id_user = $_POST['id_user'] ?? '';
    $estatus = $_POST['estatus'] ?? '';
    $cliente = $_POST['cliente'] ?? '';
    $nombre_proyecto = $_POST['nombre_proyecto'] ?? '';
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
    $fotodistancias = $_POST['fotodistancias'] ?? null; // Si está vacío es null
    $tolerancia_fotodistancias = $_POST['tolerancia_fotodistancias'] ?? null;
    $calibre = $_POST['calibre']?? '';
    $tolerancia_calibre = $_POST['tolerancia_calibre']?? '';
    $peso = $_POST['peso']?? '';
    $tolerancia_peso = $_POST['tolerancia_peso']?? '';
    $largo = $_POST['largo']?? '';
    $tolerancia_largo = $_POST['tolerancia_largo']?? '';
    $fuelle = $_POST['tolerancifuellea_peso']?? '';
    $tolerancia_fuelle = $_POST['tolerancia_fuelle']?? '';


    // Validar datos obligatorios
    if (empty($id_user)) {
        echo "El campo id_user es obligatorio.";
        exit;
    }

    // Verificar que el id_user existe en la tabla users
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user'");
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "El id_user no existe en la tabla users.";
        exit;
    }

    // Preparar la declaración SQL
    $stmt = mysqli_prepare($conn, "
        INSERT INTO form1 (
            id_form1, status_form1,
            id_user, name_user,
            name_client, project_name,
            rfq_number, delivery_format,
            packaging_format, convenience_element_of_packaging,
            filling_process, packaging_system,
            sales_unit, volume_per_order,
            annual_volume, printing_system,
            number_of_colors, width_mm,
            width_tolerance_mm, photo_distances_mm,
            photo_distances_tolerance_mm,
            thickness_microns, thickness_tolerance_microns,
            weight_gm2,weight_tolerance_gm2,
            length_mm, length_tolerance_mm,
            gusset_mm, gusset_tolerance_mm
            
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
          ?, ?, ?, ?, ?, ?, ?, ?))
    "); 

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt, 
        "ssisssissssssiisidddddddddddd", 
        $id_form1, $estatus,
        $id_user, $solicitante,
        $cliente, $nombre_proyecto,
        $numero_rfq, $formato_entrega,
        $formato_empaque, $elemento_conveniencia,
        $proceso_llenado, $sistema_empaque,
        $unidad_venta, $volumen_pedido,
        $volumen_anual, $sistema_impresion,
        $numero_colores, $ancho,
        $tolerancia_ancho, $fotodistancias,
        $tolerancia_fotodistancias,
        $calibre, $tolerancia_calibre,
        $peso, $tolerancia_peso,
        $largo, $tolerancia_largo,
        $fuelle, $tolerancia_fuelle
    );

    // Ejecutar la declaración
    if (mysqli_stmt_execute($stmt)) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
