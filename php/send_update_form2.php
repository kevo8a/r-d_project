<?php
include '../php/db_connection.php';

$id_formulario = isset($_POST['id_formulario']) ? $_POST['id_formulario'] : null;

if (!$id_formulario) {
    echo "ID de formulario no proporcionado. No se puede actualizar.";
    exit;
}

$table_content = [];

// Recibir datos del formulario
$form_data = [
    'completed_at' => $_POST['completed_at'] ?? '',
    'name_client' => $_POST['client'] ?? '',
    'status_form2' => $_POST['status'] ?? '',
];

// Procesar los datos de la tabla de materiales
for ($i = 1; $i <= 5; $i++) {
    $table_content["mtl$i"]      = $_POST["mtl$i"] ?? '';
    $table_content["material$i"] = $_POST["material$i"] ?? '';
    $table_content["caliber$i"]  = $_POST["caliber$i"] ?? '';
    $table_content["weight$i"]   = $_POST["weight$i"] ?? '';
    $table_content["solid$i"]    = $_POST["solid$i"] ?? '';
}

// Guardar el contenido de la tabla en formato JSON
$form_data['table_content'] = json_encode($table_content);

// Procesar los pasos de proceso
for ($step = 1; $step <= 6; $step++) {
    $form_data["proceso$step"] = $_POST["proceso$step"] ?? '';
}

// Actualizar el registro existente
$sql = "UPDATE form2 SET 
<<<<<<< HEAD
        name_user    =?, site_user     =?, id_user     =?, qualified_by = ?, 
        created_at   =?, completed_at  =?, name_client =?, status_form2 =?, 
        project_name =?, table_content =?, proceso1    =?, proceso2     =?, 
        proceso3     =?, proceso4      =?, proceso5    =?, proceso6     =? 
        WHERE id =?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssssssssssssi", 
  $form_data['name_user']   , $form_data['site_user'], $form_data['id_user'] , $form_data['qualified_by'],
        $form_data['created_at']  , $form_data['completed_at'] , $form_data['name_client'], $form_data['status_form2'], 
        $form_data['project_name'], $form_data['table_content'], $form_data['proceso1']   , $form_data['proceso2']    , 
        $form_data['proceso3']    , $form_data['proceso4']     , $form_data['proceso5']   , $form_data['proceso6']    , 
        $id_formulario);
=======
        name_user    = ?, site_user     = ?, id_user     = ?, qualified_by = ?, 
        created_at   = ?, completed_at  = ?, name_client = ?, status_form2 = ?, 
        project_name = ?, table_content = ?, proceso1    = ?, proceso2     = ?, 
        proceso3     = ?, proceso4      = ?, proceso5    = ?, proceso6     = ? 
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssssssssssssi", 
    $form_data['name_user']   , $form_data['site_user']    , $form_data['id_user']    , $form_data['qualified_by'],
    $form_data['created_at']  , $form_data['completed_at'] , $form_data['name_client'], $form_data['status_form2'], 
    $form_data['project_name'], $form_data['table_content'], $form_data['proceso1']   , $form_data['proceso2']    , 
    $form_data['proceso3']    , $form_data['proceso4']     , $form_data['proceso5']   , $form_data['proceso6']    , 
    $id_formulario);
>>>>>>> 9fb1e8b514c023b6b97b5dbc99138e2d9398cf51

if (mysqli_stmt_execute($stmt)) {
    echo "Formulario actualizado con éxito.";
} else {
    echo "Error al actualizar el formulario: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
