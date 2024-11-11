<?php
include '../php/db_connection.php';

// Verificar si se recibió un id de formulario para transferir
if (isset($_POST['id_form1'])) {
    $id_form1 = $_POST['id_form1'];

    // Recuperar los datos de form1
    $sql = "SELECT * FROM form1 WHERE id_form1 = '$id_form1'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $form1_data = $result->fetch_assoc();

        // Insertar los datos en form2
        $id_form2 = $form1_data['id_form1'];
        $id_user = $form1_data['id_user'];
        $table_content = '{}';  // Representación JSON vacía
        $name_user = $form1_data['name_user'];
        $site_user = $form1_data['site_user'];
        $name_client = $form1_data['name_client'];
        $project_name = $form1_data['project_name'];
        $status_form2 = 'Nuevo';  // Asumiendo que se aprueba al pasar de form1 a form2
        $created_at = date("Y-m-d H:i:s");
        $completed_at = null; // Esto podría llenarse más tarde si lo deseas
        $qualified_by = 'admin'; // Suponiendo que el encargado es 'admin'

        // Insertar en form2
        $sql2 = "INSERT INTO form2 (id_form2, status_form2, id_user, created_at, table_content ,name_user, site_user, name_client, project_name)
                 VALUES ('$id_form2', '$status_form2', '$id_user', '$created_at','$table_content ', '$name_user', '$site_user', '$name_client', '$project_name')";

        if ($conn->query($sql2) === TRUE) {
            echo "Nuevo registro creado exitosamente en form2.";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

        // Actualizar estado de form1 a "Complete" (opcional)
        $sql3 = "UPDATE form1 SET status_form1 = 'Complete' WHERE id_form1 = '$id_form1'";
        if ($conn->query($sql3) === TRUE) {
            echo "Formulario de form1 actualizado a 'Complete'.";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
    } else {
        echo "No se encontró el formulario con ID: $id_form1";
    }
}

$conn->close();
?>

<!-- Formulario para capturar el id_form1 a pasar a form2 -->
<form method="POST" action="">
    <label for="id_form1">ID Formulario (form1):</label>
    <input type="text" id="id_form1" name="id_form1" required>
    <input type="submit" value="Transferir a Form2">
</form>
