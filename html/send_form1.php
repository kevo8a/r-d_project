<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $cliente = $_POST['cliente'];
    $solicitante = $_POST['solicitante'];
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $numero_rfq = $_POST['numero_rfq'];
    $formato_entrega = $_POST['formato_entrega'];
    $formato_empaque = $_POST['formato_empaque'];
    $elemento_conveniencia = $_POST['elemento_conveniencia'];
    $proceso_llenado = $_POST['proceso_llenado'];
    $sistema_empaque = $_POST['sistema_empaque'];
    $unidad_venta = $_POST['unidad_venta'];
    $volumen_pedido = $_POST['volumen_pedido'];
    $volumen_anual = $_POST['volumen_anual'];
    $sistema_impresion = $_POST['sistema_impresion'];
    $numero_colores = $_POST['numero_colores'];
    $ancho = $_POST['ancho'];
    $tolerancia_ancho = $_POST['tolerancia_ancho'];
    $fotodistancias = $_POST['fotodistancias'] ?? null; // Si está vacio es null
    $tolerancia_fotodistancias = $_POST['tolerancia_fotodistancias'] ?? null;
    $largo = $_POST['largo'];
    $tolerancia_largo = $_POST['tolerancia_largo'];
    $fuelle = $_POST['fuelle'];
    $tolerancia_fuelle = $_POST['tolerancia_fuelle'];
    $traslape = $_POST['traslape'];
    $tolerancia_traslape = $_POST['tolerancia_traslape'];
    $codigo_sostenibilidad = $_POST['codigo_sostenibilidad'] ?? null;
    $ficha_tecnica = isset($_POST['ficha_tecnica']) ? "Sí" : "No";
    $muestra_fisica = isset($_POST['muestra_fisica']) ? "Sí" : "No";
    $plano_mecanico = isset($_POST['plano_mecanico']) ? "Sí" : "No";
    $pdf_arte = isset($_POST['pdf_arte']) ? "Sí" : "No";

    // Validación de adjuntos
    if ($ficha_tecnica == "No" && $muestra_fisica == "No") {
        echo "Debe adjuntar la ficha técnica o la muestra física.";
        exit;
    }

    // Aquí puedes procesar los datos como enviarlos por correo o guardarlos en una base de datos

    echo "Formulario enviado con éxito.";
}
