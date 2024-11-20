<?php
include 'db_connection.php';
include 'auth.php';

// Check if the form data is being sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $id_formulario            = isset($_POST['id_formulario'])              ? $_POST['id_formulario'] : null;
    $cantidad_solicitada      = isset($_POST['cantidad_solicitada'])        ? $_POST['cantidad_solicitada'] : '';
    $unidad_cantidad          = isset($_POST['unidad_cantidad'])            ? $_POST['unidad_cantidad'] : '';
    $facturable               = isset($_POST['facturable'])                 ? $_POST['facturable'] : '';
    $fotocelda                = isset($_POST['fotocelda'])                  ? $_POST['fotocelda'] : '';
    $num_colores              = isset($_POST['num_colores'])                ? $_POST['num_colores'] : '';
    // $photocell_colors         = isset($_POST['photocell_colors'])           ? $_POST['photocell_colors'] : '';
    $sistema_impresion        = isset($_POST['sistema_impresion'])          ? $_POST['sistema_impresion'] : '';
    $ext_diameter             = isset($_POST['ext_diameter'])               ? $_POST['ext_diameter'] : '';
    $tol_sign_ext_diameter    = isset($_POST['tol_sign_ext_diameter'])      ? $_POST['tol_sign_ext_diameter'] : '';
    $tol_ext_diameter         = isset($_POST['tol_ext_diameter'])           ? $_POST['tol_ext_diameter'] : '';
    $int_diameter             = isset($_POST['int_diameter'])               ? $_POST['int_diameter'] : '';
    $tol_sign_int_diameter    = isset($_POST['tol_sign_int_diameter'])      ? $_POST['tol_sign_int_diameter'] : '';
    $tol_int_diameter         = isset($_POST['tol_int_diameter'])           ? $_POST['tol_int_diameter'] : '';
    $coil_width               = isset($_POST['coil_width'])                 ? $_POST['coil_width'] : '';
    $tol_sign_coil_width      = isset($_POST['antol_sign_coil_widthcho'])   ? $_POST['tol_sign_coil_width'] : '';
    $tol_coil_width           = isset($_POST['tol_coil_width'])             ? $_POST['tol_coil_width'] : '';
    $coil_weight_kg           = isset($_POST['coil_weight_kg'])             ? $_POST['coil_weight_kg']          : '';
    $tol_sign_coil_weight     = isset($_POST['tol_sign_coil_weight'])       ? $_POST['tol_sign_coil_weight']: '';
    $tol_coil_weight_kg       = isset($_POST['tol_coil_weight_kg'])         ? $_POST['tol_coil_weight_kg'] : '';
    $winding_count            = isset($_POST['winding_count'])              ? $_POST['winding_count'] : '';
    $winding_direction        = isset($_POST['winding_direction'])          ? $_POST['winding_direction'] : '';
    $tack_dist                = isset($_POST['tack_dist'])                  ? $_POST['tack_dist'] : '';
    $tol_sign_tack_dist       = isset($_POST['tol_sign_tack_dist'])         ? $_POST['tol_sign_tack_dist'] : '';
    $tol_tack_dist            = isset($_POST['tol_tack_dist'])              ? $_POST['tol_tack_dist'] : '';
    $photcell1_edge_dist      = isset($_POST['photcell1_edge_dist'])        ? $_POST['photcell1_edge_dist']: '';
    $tol_sign_photocell1_edge = isset($_POST['tol_sign_photocell1_edge'])   ? $_POST['tol_sign_photocell1_edge']: '';
    $tol_photocell1_edge      = isset($_POST['tol_photocell1_edge'])        ? $_POST['tol_photocell1_edge'] : '';
    $photocell1_width         = isset($_POST['photocell1_width'])           ? $_POST['photocell1_width'] : '';
    $photocell1_height        = isset($_POST['photocell1_height'])          ? $_POST['photocell1_height'] : '';
    $photocell1_position      = isset($_POST['photocell1_position'])        ? $_POST['photocell1_position'] : '';
    $photcell2_edge_dist      = isset($_POST['photcell2_edge_dist'])        ? $_POST['photcell2_edge_dist'] : '';
    $tol_sign_photocell2_edge = isset($_POST['tol_sign_photocell2_edge'])   ? $_POST['tol_sign_photocell2_edge'] : '';
    $tol_photocell2_edge      = isset($_POST['tol_photocell2_edge'])        ? $_POST['tol_photocell2_edge'] : '';
    $photocell2_width         = isset($_POST['photocell2_width'])           ? $_POST['photocell2_width'] : '';
    $photocell2_height        = isset($_POST['photocell2_height'])          ? $_POST['photocell2_height'] : '';
    $photocell2_position      = isset($_POST['photocell2_position'])        ? $_POST['photocell2_position'] : '';
    $comentarios              = isset($_POST['comentarios'])                ? $_POST['comentarios'] : '';



    // Prepare the SQL query to update the record
    $sql = "UPDATE form3 SET 
            requested_qty       =?, requested_units          =?, billable_sample       =?, 
            photocell           =?, num_colors               =?, 
            printing_system     =?, ext_diameter             =?, tol_sign_ext_diameter =?, 
            tol_ext_diameter    =?, int_diameter             =?, tol_sign_int_diameter =?, 
            tol_int_diameter    =?, coil_width               =?, tol_sign_coil_width   =?,
            tol_coil_width      =?, coil_weight_kg           =?, tol_sign_coil_weight  =?, 
            tol_coil_weight_kg  =?, winding_count            =?, winding_direction     =?, 
            tack_dist           =?, tol_sign_tack_dist       =?, tol_tack_dist         =?, 
            photcell1_edge_dist =?, tol_sign_photocell1_edge =?, tol_photocell1_edge   =?, 
            photocell1_width    =?, photocell1_height        =?, photocell1_position   =?, 
            photcell2_edge_dist =?, tol_sign_photocell2_edge =?, tol_photocell2_edge   =?, 
            photocell2_width    =?, photocell2_height        =?, photocell2_position   =?
    WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "isssisisiisiisiisiisisiisiiisisiiisi", 
        $cantidad_solicitada , $unidad_cantidad          , $facturable            , 
        $fotocelda           , $num_colores              ,
        $sistema_impresion   , $ext_diameter             , $tol_sign_ext_diameter , 
        $tol_ext_diameter    , $int_diameter             , $tol_sign_int_diameter , 
        $tol_int_diameter    , $coil_width               , $tol_sign_coil_width   ,
        $tol_coil_width      , $coil_weight_kg           , $$tol_sign_coil_weight , 
        $tol_coil_weight_kg  , $winding_count            , $winding_direction     , 
        $tack_dist           , $tol_sign_tack_dist       , $tol_tack_dist         , 
        $photcell1_edge_dist , $tol_sign_photocell1_edge , $tol_photocell1_edge   , 
        $photocell1_width    , $photocell1_height        , $photocell1_position   , 
        $photcell2_edge_dist , $tol_sign_photocell2_edge , $tol_photocell2_edge   , 
        $photocell2_width    , $photocell2_height        , $photocell2_position   ,
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
