<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: login.php");
    exit();
}

// Obtener el id del formulario de la URL
if (!isset($_GET['id'])) {
    die('ID del formulario no proporcionado.');
}

$id_formulario = $_GET['id'];

// Conectar a la base de datos
require '../php/db_connection.php';

// Consultar los datos del formulario por su ID
$sql = "SELECT * FROM form1 WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_formulario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verificar si se encontró el formulario
if ($result->num_rows === 0) {
    die('Formulario no encontrado.');
}

// Obtener los datos del formulario
$form_data = mysqli_fetch_assoc($result);

mysqli_close($conn);

// Obtener datos de sesión del usuario
$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$last_name = $_SESSION['user_last_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Editar Formulario Cotización</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container">
                    <h1 class="text-center mb-4">Editar Formulario de Cotización</h1>
                    <form action="update_form1.php" method="POST">
                        <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">
                        <div class="row">

                            <!-- Cliente -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" id="cliente" name="cliente" required>
                                        <option value="" disabled selected>Selecciona un cliente</option>
                                        <?php
                                        require '../php/db_connection.php';

                                        $sql_clientes = "SELECT name FROM client";
                                        $result_clientes = mysqli_query($conn, $sql_clientes);

                                        if ($result_clientes) {
                                            while ($row_cliente = mysqli_fetch_assoc($result_clientes)) {
                                                // Selecciona el cliente actual del formulario
                                                $selected = ($row_cliente['name'] == $form_data['name_client']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($row_cliente['name']) . '" ' . $selected . '>' . htmlspecialchars($row_cliente['name']) . '</option>';
                                            }
                                        }

                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Solicitante -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="solicitante" class="form-label">Solicitante</label>
                                    <input type="text" class="form-control" id="solicitante" name="solicitante"
                                        value="<?php echo htmlspecialchars($name) . ' ' . htmlspecialchars($last_name); ?>" readonly>
                                </div>
                            </div>

                            <!-- ID Usuario -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user"
                                        value="<?php echo htmlspecialchars($user_id); ?>" readonly>
                                </div>
                            </div>

                            <!-- Nombre de proyecto -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto/Producto</label>
                                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto"
                                        value="<?php echo htmlspecialchars($form_data['project_name']); ?>" required>
                                </div>
                            </div>

                            <!-- Estatus -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="estatus" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus"
                                        value="<?php echo htmlspecialchars($form_data['status_form1']); ?>" readonly>
                                </div>
                            </div>

                            <!-- Número de RFQ -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                RFQ</label>
                                    <input type="number" class="form-control" id="numero_rfq" name="numero_rfq"
                                        value="<?php echo htmlspecialchars($form_data['rfq_number']); ?>" required>
                                </div>
                            </div>

                            <!-- Formato de Entrega -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formato_entrega" class="form-label">Formato de Entrega</label>
                                    <select class="form-control" id="formato_entrega" name="formato_entrega" required>
                                        <option value="Rollo/Bobina" <?php echo ($form_data['delivery_format'] == 'Rollo/Bobina') ? 'selected' : ''; ?>>Rollo/Bobina</option>
                                        <option value="Sachet" <?php echo ($form_data['delivery_format'] == 'Sachet') ? 'selected' : ''; ?>>Sachet</option>
                                        <option value="Bolsa Preformada" <?php echo ($form_data['delivery_format'] == 'Bolsa Preformada') ? 'selected' : ''; ?>>Bolsa Preformada</option>
                                        <option value="Tubular" <?php echo ($form_data['delivery_format'] == 'Tubular') ? 'selected' : ''; ?>>Tubular</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Botón Enviar -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar Cotización</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
