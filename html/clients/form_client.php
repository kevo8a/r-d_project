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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Navbar -->
                <?php include '../structure/navbar.php'; ?>

                <!-- Contenido del Formulario -->
                <div class="container mt-4">
                    <h1 class="text-center"><?php echo $id_formulario ? 'Editar' : 'Crear'; ?> Formulario</h1>
                    <form id="form-client" method="POST">
                        <?php if ($id_formulario): ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id_formulario); ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="name_client" class="form-label">Nombre de la empresa</label>
                            <input type="text" class="form-control" id="name_client" name="name_client"
                                value="<?php echo $id_formulario ? htmlspecialchars($form_data['name_client']) : ''; ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="representative" class="form-label">Nombre del representante</label>
                            <input type="text" class="form-control" id="representative" name="representative"
                                value="<?php echo $id_formulario ? htmlspecialchars($form_data['representative']) : ''; ?>"
                                required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2 col-lg-1">
                                <label for="lada" class="form-label">Lada</label>
                                <input type="text" class="form-control" id="lada" name="lada" maxlength="3"
                                    pattern="\d{2,3}" title="La lada debe contener 2 o 3 dígitos" placeholder="Ej: 55"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['lada']) : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-10 col-lg-6">
                                <label for="tel" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="tel" name="tel" maxlength="10"
                                    pattern="\d{10}" title="El teléfono debe contener exactamente 10 dígitos"
                                    placeholder="Ej: 1234567890"
                                    value="<?php echo $id_formulario ? htmlspecialchars($form_data['tel']) : ''; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $id_formulario ? htmlspecialchars($form_data['email']) : ''; ?>"
                                required>
                        </div>
                        <button type="submit" id="submit-btn" class="btn btn-primary">Enviar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom script -->
    <script>
    $(document).ready(function() {
        $('#form-client').submit(function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            const action =
                "<?php echo $id_formulario ? '../../php/update_client.php' : '../../php/send_form3.php'; ?>";

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