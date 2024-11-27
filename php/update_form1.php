<?php
include 'db_connection.php';
include 'auth.php';

// Check if the form data is being sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $id_formulario             = isset($_POST['id_formulario'])            ? $_POST['id_formulario'] : null;
    $cliente                   = isset($_POST['cliente'])                  ? $_POST['cliente'] : '';
    $nombre_proyecto           = isset($_POST['nombre_proyecto'])          ? $_POST['nombre_proyecto'] : '';
    $numero_rfq                = isset($_POST['numero_rfq'])               ? $_POST['numero_rfq'] : '';
    $estatus                   = 'En Proceso';
    $numero_rfq                = isset($_POST['numero_rfq'])               ? $_POST['numero_rfq'] : '';
    $formato_entrega           = isset($_POST['formato_entrega'])          ? $_POST['formato_entrega'] : '';
    $formato_empaque           = isset($_POST['formato_empaque'])          ? $_POST['formato_empaque'] : '';
    $elemento_conveniencia     = isset($_POST['elemento_conveniencia'])    ? $_POST['elemento_conveniencia'] : '';
    $proceso_llenado           = isset($_POST['proceso_llenado'])          ? $_POST['proceso_llenado'] : '';
    $sistema_empaque           = isset($_POST['sistema_empaque'])          ? $_POST['sistema_empaque'] : '';
    $unidad_venta              = isset($_POST['unidad_venta'])             ? $_POST['unidad_venta'] : '';
    $volumen_pedido            = isset($_POST['volumen_pedido'])           ? $_POST['volumen_pedido'] : '';
    $volumen_anual             = isset($_POST['volumen_anual'])            ? $_POST['volumen_anual'] : '';
    $sistema_impresion         = isset($_POST['sistema_impresion'])        ? $_POST['sistema_impresion'] : '';
    $numero_colores            = isset($_POST['numero_colores'])           ? $_POST['numero_colores'] : '';
    $ancho                     = isset($_POST['ancho'])                    ? $_POST['ancho'] : '';
    $tolerancia_ancho          = isset($_POST['tolerancia_ancho'])         ? $_POST['tolerancia_ancho'] : '';
    $fotodistancias            = isset($_POST['fotodistancias'])           ? $_POST['fotodistancias']          : '';
    $tolerancia_fotodistancias = isset($_POST['tolerancia_fotodistancias'])? $_POST['tolerancia_fotodistancias']: '';
    $calibre                   = isset($_POST['calibre'])                  ? $_POST['calibre'] : '';
    $tolerancia_calibre        = isset($_POST['tolerancia_calibre'])       ? $_POST['tolerancia_calibre'] : '';
    $peso                      = isset($_POST['peso'])                     ? $_POST['peso'] : '';
    $tolerancia_peso           = isset($_POST['tolerancia_peso'])          ? $_POST['tolerancia_peso'] : '';
    $es_bolsa                  = isset($_POST['es_bolsa'])                 ? 1 : 0;
    $continuous_check          = isset($_POST['continuous_check'])         ? 1 : 0;
    $largo                     = isset($_POST['largo'])                    ? $_POST['largo'] : '';
    $tolerancia_largo          = isset($_POST['tolerancia_largo'])         ? $_POST['tolerancia_largo'] : '';
    $fuelle                    = isset($_POST['fuelle'])                   ? $_POST['fuelle']: '';
    $tolerancia_fuelle         = isset($_POST['tolerancia_fuelle'])        ? $_POST['tolerancia_fuelle']: '';
    $traslape                  = isset($_POST['traslape'])                 ? $_POST['traslape'] : '';
    $tolerancia_traslape       = isset($_POST['tolerancia_traslape'])      ? $_POST['tolerancia_traslape'] : '';
    $ficha_tecnica             = isset($_POST['ficha_tecnica'])            ? 1 : 0;
    $muestra_fisica            = isset($_POST['muestra_fisica'])           ? 1 : 0;
    $plano_mecanico            = isset($_POST['plano_mecanico'])           ? 1 : 0;
    $pdf_arte                  = isset($_POST['pdf_arte'])                 ? 1 : 0;
    $created_at                = date("y-m-d H:i");


    // Prepare the SQL query to update the record
    $sql = "UPDATE form1 SET 
    name_client                  =?, project_name                       =?, rfq_number                  =?,
    status_form1                 =?, rfq_number                         =?, delivery_format             =?, 
    packaging_format             =?, convenience_element_of_packaging   =?, filling_process             =?,
    packaging_system             =?, sales_unit                         =?, volume_per_order            =?,
    annual_volume                =?, printing_system                    =?, number_of_colors            =?,
    width_mm                     =?, width_tolerance_mm                 =?, photo_distances_mm          =?,
    photo_distances_tolerance_mm =?, thickness_microns                  =?, thickness_tolerance_microns =?,
    weight_gm2                   =?, weight_tolerance_gm2               =?, bag_check                   =?,
    continuous_check             =?, length_mm                          =?, length_tolerance_mm         =?,
    gusset_mm                    =?, gusset_tolerance_mm                =?, overlap_mm                  =?,
    overlap_tolerance_mm         =?, technical_sheet                    =?, physical_sample             =?, 
    mechanical_plan              =?, pdf_art                            =?, created_at                  =?
    WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssisissssssiisiiiiiiiiiiiiiiiiiiiiisi", 
        $cliente                  ,$nombre_proyecto        , $numero_rfq        ,
        $estatus                  , $numero_rfq            , $formato_entrega   ,
        $formato_empaque          , $elemento_conveniencia , $proceso_llenado   ,
        $sistema_empaque          , $unidad_venta          , $volumen_pedido    ,
        $volumen_anual            , $sistema_impresion     , $numero_colores    ,
        $ancho                    , $tolerancia_ancho      , $fotodistancias    ,
        $tolerancia_fotodistancias, $calibre               , $tolerancia_calibre,
        $peso                     , $tolerancia_peso       , $es_bolsa          , 
        $continuous_check         , $largo                 , $tolerancia_largo  ,
        $fuelle                   , $tolerancia_fuelle     , $traslape          , 
        $tolerancia_traslape      , $ficha_tecnica         , $muestra_fisica    ,
        $plano_mecanico           , $pdf_arte              , $created_at        ,
        $id_formulario);

        // Execute the query
        $result = mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if ($result) {
            echo "success";
        } else {
            echo "Error: No se pudo actualizar el formulario.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Consulta no válida.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Error: Solicitud no válida.";
}
?>
