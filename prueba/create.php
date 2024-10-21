<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ficha_tecnica = isset($_POST['ficha_tecnica']) ? 1 : 0;
    $muestra_fisica = isset($_POST['muestra_fisica']) ? 1 : 0;
    $plano_mecanico = isset($_POST['plano_mecanico']) ? 1 : 0;
    $pdf_art = isset($_POST['pdf_arte']) ? 1 : 0;

    $query = "INSERT INTO form1 (technical_sheet, physical_sample, mechanical_plan, pdf_art) 
              VALUES ('$ficha_tecnica', '$muestra_fisica', '$plano_mecanico', '$pdf_art')";

    if (mysqli_query($conn, $query)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<form action="create.php" method="POST">
    <label for="ficha_tecnica">Ficha Técnica</label>
    <input type="checkbox" name="ficha_tecnica" id="ficha_tecnica">
    <br>

    <label for="muestra_fisica">Muestra Física</label>
    <input type="checkbox" name="muestra_fisica" id="muestra_fisica">
    <br>

    <label for="plano_mecanico">Plano Mecánico</label>
    <input type="checkbox" name="plano_mecanico" id="plano_mecanico">
    <br>

    <label for="pdf_arte">PDF Arte</label>
    <input type="checkbox" name="pdf_arte" id="pdf_arte">
    <br>

    <button type="submit">Crear</button>
</form>
