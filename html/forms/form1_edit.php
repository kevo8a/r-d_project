<?php
include '../../php/db_connection.php';
include '../../php/auth.php';

// Obtener el ID del formulario de la URL (para editar)
$id_formulario = isset($_GET['id']) ? $_GET['id'] : null;
$form_data = [];

// Si hay un ID, consultar los datos del formulario por su ID
if ($id_formulario) {
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
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amcor - Formulario Cotización</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../js/js.js"></script>
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
                <div class="container">
                    <h1 class="text-center mb-4"><?php echo $id_formulario ? 'Editar' : 'Crear'; ?> Formulario de Cotización</h1>
                    <form action="../../php/<?php echo $id_formulario ? 'update_form1_create_edit.php' : 'send_form1_create_edit.php'; ?>" method="POST">
                        <?php if ($id_formulario): ?>
                            <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">
                        <?php endif; ?>
                        <div class="row">

                            <!-- Cliente -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" id="cliente" name="cliente" required>
                                        <option value="" disabled selected>Selecciona un cliente</option>
                                        <?php
                                        require '../../php/db_connection.php';

                                        $sql_clientes = "SELECT name FROM client";
                                        $result_clientes = mysqli_query($conn, $sql_clientes);

                                        if ($result_clientes) {
                                            while ($row_cliente = mysqli_fetch_assoc($result_clientes)) {
                                                // Selecciona el cliente actual del formulario si se está editando
                                                $selected = ($id_formulario && $row_cliente['name'] == $form_data['name_client']) ? 'selected' : '';
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
                                        value="<?php echo htmlspecialchars($name) . ' ' . htmlspecialchars($last_name); ?>"
                                        readonly>
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
                                        value="<?php echo $id_formulario ? htmlspecialchars($form_data['nombre_proyecto']) : ''; ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Botón de Envío -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><?php echo $id_formulario ? 'Actualizar' : 'Enviar'; ?> Cotización</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
