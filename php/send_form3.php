<?php
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta


// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_form3                 = uniqid('FS-');
    $solicitante              = $_POST['solicitante'];
    $site                     = $_POST['site_user'];
    $id_user                  = $_POST['id_user'];
    $created_at               = $_POST['created_at'];
    $status                   = $_POST['status'];
    $cliente                  = $_POST['cliente'];
    $nombre_proyecto          = $_POST['nombre_proyecto'];
    $cantidad_solicitada      = $_POST['cantidad_solicitada'];
    $unidad_cantidad          = $_POST['unidad_cantidad'];
    $facturable               = $_POST['facturable'];
    $fotocelda                = $_POST['fotocelda'];
    $num_colores              = $_POST['num_colores'];
    $photocell_colors         = '[]';
    $sistema_impresion        = $_POST['sistema_impresion'];
    $ext_diameter             = $_POST['ext_diameter'];
    $tol_sign_ext_diameter    = $_POST['tol_sign_ext_diameter'];
    $tol_ext_diameter         = $_POST['tol_ext_diameter'];
    $int_diameter             = $_POST['int_diameter'];
    $tol_sign_int_diameter    = $_POST['tol_sign_int_diameter'];
    $tol_int_diameter         = $_POST['tol_int_diameter'];
    $coil_width               = $_POST['coil_width'];
    $tol_sign_coil_width      = $_POST['tol_sign_coil_width'];
    $tol_coil_width           = $_POST['tol_coil_width'];
    $coil_weight_kg           = $_POST['coil_weight_kg'];
    $tol_sign_coil_weight     = $_POST['tol_sign_coil_weight'];
    $tol_coil_weight_kg       = $_POST['tol_coil_weight_kg'];
    $winding_count            = $_POST['winding_count'];
    $winding_direction        = $_POST['winding_direction'];
    $tack_dist                = $_POST['tack_dist'];
    $tol_sign_tack_dist       = $_POST['tol_sign_tack_dist'];
    $tol_tack_dist            = $_POST['tol_tack_dist'];
    $photcell1_edge_dist      = $_POST['photcell1_edge_dist'];
    $tol_sign_photocell1_edge = $_POST['tol_sign_photocell1_edge'];
    $tol_photocell1_edge      = $_POST['tol_photocell1_edge'];
    $photocell1_width         = $_POST['photocell1_width'];
    $photocell1_height        = $_POST['photocell1_height'];
    $photocell1_position      = $_POST['photocell1_position'];
    $photcell2_edge_dist      = $_POST['photcell2_edge_dist'];    
    $tol_sign_photocell2_edge = $_POST['tol_sign_photocell2_edge'];
    $tol_photocell2_edge      = $_POST['tol_photocell2_edge'];
    $photocell2_width         = $_POST['photocell2_width'];
    $photocell2_height        = $_POST['photocell2_height'];
    $photocell2_position      = $_POST['photocell2_position'];
    $comentarios              = $_POST['comments'] ?? null;

    
    // Preparar la declaración SQL
    $stmt = mysqli_prepare($conn, "
        INSERT INTO form3 (
            id_form3                , name_user            , site_user          ,
            id_user                 , created_at           , status_form3       ,
            name_client             , project_name         , requested_qty      , 
            requested_units         , billable_sample      , photocell          ,
            num_colors              , photocell_colors     , printing_system    ,
            ext_diameter            , tol_sign_ext_diameter, tol_ext_diameter   ,
            int_diameter            , tol_sign_int_diameter, tol_int_diameter   , 
            coil_width              , tol_sign_coil_width  , tol_coil_width     ,
            coil_weight_kg          , tol_sign_coil_weight , tol_coil_weight_kg ,
            winding_count           , winding_direction    , tack_dist          ,
            tol_sign_tack_dist      , tol_tack_dist        , photcell1_edge_dist, 
            tol_sign_photocell1_edge, tol_photocell1_edge  , photocell1_width   ,
            photocell1_height       , photocell1_position  , photcell2_edge_dist, 
            tol_sign_photocell2_edge, tol_photocell2_edge  , photocell2_width   , 
            photocell2_height       , photocell2_position

        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    "); 

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt, 
        "sssissssisssissisiisiisiisiisisiisiiisisiiis", 
        $id_form3                , $solicitante          , $site               ,
        $id_user                 , $created_at           , $status             ,
        $cliente                 , $nombre_proyecto      , $cantidad_solicitada, 
        $unidad_cantidad         , $facturable           , $fotocelda          ,
        $num_colores             , $photocell_colors     , $sistema_impresion  ,
        $ext_diameter            , $tol_sign_ext_diameter, $tol_ext_diameter   , 
        $int_diameter            , $tol_sign_int_diameter, $tol_int_diameter   , 
        $coil_width              , $tol_sign_coil_width  , $tol_coil_width     ,
        $coil_weight_kg          , $tol_sign_coil_weight , $tol_coil_weight_kg ,
        $winding_count           , $winding_direction    , $tack_dist          ,
        $tol_sign_tack_dist      , $tol_tack_dist        , $photcell1_edge_dist, 
        $tol_sign_photocell1_edge, $tol_photocell1_edge  , $photocell1_width   ,
        $photocell1_height       , $photocell1_position  , $photcell2_edge_dist, 
        $tol_sign_photocell2_edge, $tol_photocell2_edge  , $photocell2_width   , 
        $photocell2_height       , $photocell2_position


  
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