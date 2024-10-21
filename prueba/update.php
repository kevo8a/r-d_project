<?php
include 'db_connection.php';

$data = []; // Inicializa la variable $data para evitar errores

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ficha_tecnica = isset($_POST['ficha_tecnica']) ? 1 : 0;
        $muestra_fisica = isset($_POST['muestra_fisica']) ? 1 : 0;
        $plano_mecanico = isset($_POST['plano_mecanico']) ? 1 : 0;
        $pdf_art = isset($_POST['pdf_arte']) ? 1 : 0;

        $query = "UPDATE form1 SET 
                    technical_sheet = '$ficha_tecnica',
                    physical_sample = '$muestra_fisica',
                    mechanical_plan = '$plano_mecanico',
                    pdf_art = '$pdf_art'
                  WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        exit; // Salir después de la actualización
    } else {
        $query = "SELECT * FROM form1 WHERE id = $id";
        $result = mysqli_query($conn, $query);
        
        // Verifica si la consulta devolvió resultados
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
        } else {
            echo "No se encontraron datos para el ID especificado.";
            mysqli_close($conn);
            exit; // Salir si no hay datos
        }
    }
} else {
    echo "ID no proporcionado.";
    exit; // Salir si no hay ID
}
?>

<form action="update.php?id=<?php echo $id; ?>" method="POST">
    <label for="ficha_tecnica">Ficha Técnica</label>
    <input type="checkbox" name="ficha_tecnica" id="ficha_tecnica" <?php echo isset($data['technical_sheet']) && $data['technical_sheet'] ? 'checked' : ''; ?>>
    <br>

    <label for="muestra_fisica">Muestra Física</label>
    <input type="checkbox" name="muestra_fisica" id="muestra_fisica" <?php echo isset($data['physical_sample']) && $data['physical_sample'] ? 'checked' : ''; ?>>
    <br>

    <label for="plano_mecanico">Plano Mecánico</label>
    <input type="checkbox" name="plano_mecanico" id="plano_mecanico" <?php echo isset($data['mechanical_plan']) && $data['mechanical_plan'] ? 'checked' : ''; ?>>
    <br>

    <label for="pdf_arte">PDF Arte</label>
    <input type="checkbox" name="pdf_arte" id="pdf_arte" <?php echo isset($data['pdf_art']) && $data['pdf_art'] ? 'checked' : ''; ?>>
    <br>

    <button type="submit">Actualizar</button>
</form>
