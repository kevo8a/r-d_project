<?php
include '../../php/db_connection.php';
include '../../php/auth.php';


// Obtener el ID del formulario de la URL (para editar)
$id_formulario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;

// Si hay un ID, consultar los datos del formulario por su ID
$form_data = [];
if ($id_formulario) {
    $sql = "SELECT * FROM client WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_formulario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Verificar si se encontró el formulario
        if ($result->num_rows === 0) {
            die('Formulario no encontrado.');
        }

        // Obtener los datos del formulario
        $form_data = mysqli_fetch_assoc($result);
    } else {
        die('Error al preparar la consulta.');
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Solicitud Muestra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center"><?php echo $id_formulario ? 'Editar' : 'Crear'; ?> Formulario</h1>
        <form id="form-client" method="POST">
            <?php if ($id_formulario): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id_formulario); ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la empresa</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?php echo $id_formulario ? htmlspecialchars($form_data['name']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="representative" class="form-label">Nombre del representante</label>
                <input type="text" class="form-control" id="representative" name="representative"
                       value="<?php echo $id_formulario ? htmlspecialchars($form_data['representative']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="lada" class="form-label">Lada</label>
                <input type="text" class="form-control" id="lada" name="lada" maxlength="3" 
                       value="<?php echo $id_formulario ? htmlspecialchars($form_data['lada']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tel" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="tel" name="tel" maxlength="10"
                       value="<?php echo $id_formulario ? htmlspecialchars($form_data['tel']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?php echo $id_formulario ? htmlspecialchars($form_data['email']) : ''; ?>" required>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#form-client').submit(function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            const action = "<?php echo $id_formulario ? '../../php/update_client.php' : '../../php/send_form3.php'; ?>";

            $.post(action, formData, function(response) {
                try {
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert(jsonResponse.message);
                        window.location.href = "/r&d/html/index.php";
                    } else {
                        alert('Error: ' + jsonResponse.message);
                    }
                } catch (e) {
                    alert('Error procesando la respuesta del servidor.');
                }
            });
        });
    });
    </script>
</body>
</html>
