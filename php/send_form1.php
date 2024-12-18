<?php
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta


// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_form1                  = uniqid('FC-');
    $solicitante               = $_POST['solicitante'];
    $id_user                   = $_POST['id_user'];
    $estatus                   = $_POST['estatus'];
    $cliente                   = $_POST['cliente'];
    $site                      = $_POST['site_user'];
    $nombre_proyecto           = $_POST['nombre_proyecto'];
    $numero_rfq                = $_POST['numero_rfq'];
    $formato_entrega           = $_POST['formato_entrega'];
    $formato_empaque           = $_POST['formato_empaque'];
    $elemento_conveniencia     = $_POST['elemento_conveniencia'];
    $proceso_llenado           = $_POST['proceso_llenado'];
    $sistema_empaque           = $_POST['sistema_empaque'];
    $unidad_venta              = $_POST['unidad_venta'];
    $volumen_pedido            = $_POST['volumen_pedido'];
    $volumen_anual             = $_POST['volumen_anual'];
    $sistema_impresion         = $_POST['sistema_impresion'];
    $numero_colores            = $_POST['numero_colores'] ?? null;
    $ancho                     = $_POST['ancho'];
    $tolerancia_ancho          = $_POST['tolerancia_ancho'];
    $fotodistancias            = $_POST['fotodistancias'] ?? null; 
    $tolerancia_fotodistancias = $_POST['tolerancia_fotodistancias'] ?? null;
    $calibre                   = $_POST['calibre'];
    $tolerancia_calibre        = $_POST['tolerancia_calibre'];
    $peso                      = $_POST['peso'];
    $tolerancia_peso           = $_POST['tolerancia_peso'];
    $largo                     = $_POST['largo'] ?? null;
    $tolerancia_largo          = $_POST['tolerancia_largo'] ?? null;
    $fuelle                    = $_POST['fuelle'] ?? null;
    $tolerancia_fuelle         = $_POST['tolerancia_fuelle'] ?? null;
    $traslape                  = $_POST['traslape'] ?? null;
    $tolerancia_traslape       = $_POST['tolerancia_traslape'] ?? null;
    $created_at                = $_POST['created_at'];
    $comentarios               = $_POST['comments'] ?? null;
    $ficha_tecnica             = isset($_POST['ficha_tecnica']) ? 1 : 0;
    $muestra_fisica            = isset($_POST['muestra_fisica']) ? 1 : 0;
    $plano_mecanico            = isset($_POST['plano_mecanico']) ? 1 : 0;
    $pdf_arte                  = isset($_POST['pdf_arte']) ? 1 : 0;
    $es_bolsa                  = isset($_POST['es_bolsa']) ? 1 : 0;
    $continuous_check          = isset($_POST['continuous_check']) ? 1 : 0;

    // Validar datos obligatorios
    if (empty($id_user)) {
        echo "El campo id_user es obligatorio.";
        exit;
    }
    $rutaArchivo = null;
    $nombreArchivo = null;

    // Manejo de archivo subido
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Configurar la ruta del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = $id_form1 . '.' . $extension; // Cambiar el nombre del archivo
        $rutaArchivo = 'C:/xampp/htdocs/files/' . $nombreArchivo;

        // Verificar si la carpeta existe, si no, crearla
        if (!file_exists('C:/xampp/htdocs/files/')) {
            mkdir('C:/xampp/htdocs/files/', 0777, true);
        }

        // Si se está actualizando, eliminar el archivo anterior
        if (isset($_POST['old_file']) && file_exists($_POST['old_file'])) {
            unlink($_POST['old_file']);
        }

        // Mover el archivo subido a la ruta especificada
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $rutaArchivo)) {
            echo "Error al subir el archivo.";
            exit;
        }
    } else {
        // Captura el error específico
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "El archivo es demasiado grande.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "El archivo fue subido parcialmente.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No se seleccionó ningún archivo.";
                break;
            default:
                echo "Error al subir el archivo.";
                break;
        }
        exit;
    }


    // Preparar la declaración SQL
    $stmt = mysqli_prepare($conn, "
        INSERT INTO form1 (
            id_form1                        , status_form1               , id_user                     ,  
            name_user                       , name_client                , project_name                ,
            rfq_number                      , delivery_format            , packaging_format            , 
            convenience_element_of_packaging, filling_process            , packaging_system            ,
            sales_unit                      , volume_per_order           , annual_volume               , 
            printing_system                 , number_of_colors           , width_mm                    ,
            width_tolerance_mm              , photo_distances_mm         , photo_distances_tolerance_mm,
            thickness_microns               , thickness_tolerance_microns, weight_gm2                  , 
            weight_tolerance_gm2            , length_mm                  , length_tolerance_mm         ,
            gusset_mm, gusset_tolerance_mm  , overlap_mm                 , overlap_tolerance_mm        ,           
            technical_sheet                 , physical_sample            , mechanical_plan             , 
            pdf_art                         , site_user                  , bag_check                   , 
            continuous_check                , comments                   , file_rute                   , 
            file_name                       , created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    "); 

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt, 
        "ssisssissssssiisiddddddddddddssiiiisiissss", 
        $id_form1             , $estatus           , $id_user                  , 
        $solicitante          , $cliente           , $nombre_proyecto          ,
        $numero_rfq           , $formato_entrega   , $formato_empaque          , 
        $elemento_conveniencia, $proceso_llenado   , $sistema_empaque          ,
        $unidad_venta         , $volumen_pedido    , $volumen_anual            ,
        $sistema_impresion    , $numero_colores    , $ancho                    ,
        $tolerancia_ancho     , $fotodistancias    , $tolerancia_fotodistancias,
        $calibre              , $tolerancia_calibre, $peso                     ,
        $tolerancia_peso      , $largo             , $tolerancia_largo         ,
        $fuelle               , $tolerancia_fuelle , $traslape                 , 
        $tolerancia_traslape  , $ficha_tecnica     , $muestra_fisica           ,
        $plano_mecanico       , $pdf_arte, $site   , $es_bolsa                 , 
        $continuous_check     , $comentarios       , $rutaArchivo              , 
        $nombreArchivo        , $created_at
    );

    // Ejecutar la declaración
    if (mysqli_stmt_execute($stmt)) {
        // Enviar respuesta de éxito
        echo "success";
    } else {
        // Enviar mensaje de error
        echo "Error al guardar los datos: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>