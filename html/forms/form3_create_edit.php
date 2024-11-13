<?php
include '../../php/db_connection.php';
include '../../php/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../structure/navbar.php'; ?>

                <!-- Contenido -->   
                <div class="container-fluid">
                <div class="container mt-5">
                    <h2 class="mb-4">Solicitud de Muestra</h2>
                    <form>
                        <!-- Información del Proyecto -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombreProducto" class="form-label">Nombre del proyecto/Producto</label>
                                <input type="text" class="form-control" id="nombreProducto">
                            </div>
                            <div class="col-md-6">
                                <label for="solicitadoPor" class="form-label">Solicitado por</label>
                                <input type="text" class="form-control" id="solicitadoPor">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cliente" class="form-label">Cliente</label>
                                <input type="text" class="form-control" id="cliente">
                            </div>
                            <div class="col-md-6">
                                <label for="cantidadSolicitada" class="form-label">Cantidad Solicitada</label>
                                <input type="text" class="form-control" id="cantidadSolicitada">
                            </div>
                        </div>

                        <!-- Opciones adicionales -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="unidadCantidad" class="form-label">Unidades Cantidad Solicitada</label>
                                <select class="form-select" id="unidadCantidad">
                                    <option value="unidades">Unidades</option>
                                    <option value="kilogramos">Kilogramos (KG)</option>
                                    <option value="metros">Metros</option>
                                    <option value="rollos">Rollos</option>
                                    <option value="km">Kilómetro (KM)</option>
                                    <option value="pieza">Pieza (PC)</option>
                                    <option value="millares">Millares</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="facturable" class="form-label">Muestra Facturable</label>
                                <select class="form-select" id="facturable">
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fotocelda" class="form-label">¿Fotocelda?</label>
                                <select class="form-select" id="fotocelda">
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="numColores" class="form-label">Número de Colores</label>
                                <input type="number" class="form-control" id="numColores" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="coloresFotocelda" class="form-label">Colores de la Fotocelda</label>
                                <input type="text" class="form-control" id="coloresFotocelda">
                            </div>
                            <div class="col-md-6">
                                <label for="sistemaImpresion" class="form-label">Sistema de Impresión</label>
                                <select class="form-select" id="sistemaImpresion" onchange="toggleColores()">
                                    <option value="rotograbado">Rotograbado</option>
                                    <option value="flexografia">Flexografía</option>
                                    <option value="sinImpresion">Sin impresión</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dimensiones -->
                        <h4 class="mt-5">Dimensiones</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="diamExt" class="form-label">Diámetro Externo (mm)</label>
                                <input type="number" class="form-control" id="diamExt">
                            </div>
                            <div class="col-md-3">
                                <label for="signoDiamExt" class="form-label">Signo Tolerancia</label>
                                <input type="text" class="form-control" id="signoDiamExt">
                            </div>
                            <div class="col-md-3">
                                <label for="toleranciaDiamExt" class="form-label">Tolerancia Diámetro Externo (mm)</label>
                                <input type="text" class="form-control" id="toleranciaDiamExt">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="diamInt" class="form-label">Diámetro Interno (pulgadas)</label>
                                <input type="number" class="form-control" id="diamInt">
                            </div>
                            <div class="col-md-3">
                                <label for="signoDiamInt" class="form-label">Signo Tolerancia</label>
                                <input type="text" class="form-control" id="signoDiamInt">
                            </div>
                            <div class="col-md-3">
                                <label for="toleranciaDiamInt" class="form-label">Tolerancia Diámetro Interno (pulgadas)</label>
                                <input type="text" class="form-control" id="toleranciaDiamInt">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="anchoBobina" class="form-label">Ancho de Bobina (mm)</label>
                                <input type="number" class="form-control" id="anchoBobina">
                            </div>
                            <div class="col-md-3">
                                <label for="signoAnchoBobina" class="form-label">Signo Tolerancia</label>
                                <input type="text" class="form-control" id="signoAnchoBobina">
                            </div>
                            <div class="col-md-3">
                                <label for="toleranciaAncho" class="form-label">Tolerancia Ancho de Bobina (mm)</label>
                                <input type="text" class="form-control" id="toleranciaAncho">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pesoBobina" class="form-label">Peso de la Bobina (Kg)</label>
                                <input type="number" class="form-control" id="pesoBobina">
                            </div>
                            <div class="col-md-3">
                                <label for="signoPesoBobina" class="form-label">Signo Tolerancia</label>
                                <input type="text" class="form-control" id="signoPesoBobina">
                            </div>
                            <div class="col-md-3">
                                <label for="toleranciaPeso" class="form-label">Tolerancia Peso de la Bobina (Kg)</label>
                                <input type="text" class="form-control" id="toleranciaPeso">
                            </div>
                        </div>

                        <!-- Embobinado -->
                        <h4 class="mt-5">Embobinado</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="numEmbobinado" class="form-label">Número de Embobinado</label>
                                <select class="form-select" id="numEmbobinado">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sentidoEmbobinado" class="form-label">Sentido Embobinado</label>
                                <select class="form-select" id="sentidoEmbobinado">
                                    <option value="dentro">Impresión por dentro</option>
                                    <option value="fuera">Impresión por fuera</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tacas y Fotoceldas -->
                        <h4 class="mt-5">Tacas y Fotoceldas</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="distanciaTacas" class="form-label">Distancia entre Tacas o Fotodistancia (mm)</label>
                                <input type="number" class="form-control" id="distanciaTacas">
                            </div>
                            <div class="col-md-3">
                                <label for="signoDistanciaTacas" class="form-label">Signo Tolerancia</label>
                                <input type="text" class="form-control" id="signoDistanciaTacas">
                            </div>
                            <div class="col-md-3">
                                <label for="toleranciaTacas" class="form-label">Tolerancia Distancia entre Tacas (mm)</label>
                                <input type="text" class="form-control" id="toleranciaTacas">
                            </div>
                        </div>

                        <!-- Fotocelda 1 -->
                        <h5 class="mt-4">Fotocelda 1</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="distanciaFotocelda1" class="form-label">Distancia Fotocelda 1 al borde más cercano (mm)</label>
                                <input type="number" class="form-control" id="distanciaFotocelda1">
                            </div>
                            <div class="col-md-3">
                                <label for="fotocelda1Ancho" class="form-label">Fotocelda 1 Ancho (mm)</label>
                                <input type="number" class="form-control" id="fotocelda1Ancho">
                            </div>
                            <div class="col-md-3">
                                <label for="fotocelda1Alto" class="form-label">Fotocelda 1 Alto (mm)</label>
                                <input type="number" class="form-control" id="fotocelda1Alto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="posicionFotocelda1" class="form-label">Posición Fotocelda 1</label>
                                <select class="form-select" id="posicionFotocelda1">
                                    <option value="izquierda">Izquierda</option>
                                    <option value="derecha">Derecha</option>
                                    <option value="centro">Centro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Fotocelda 2 -->
                        <h5 class="mt-4">Fotocelda 2</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="distanciaFotocelda2" class="form-label">Distancia Fotocelda 2 al borde más cercano (mm)</label>
                                <input type="number" class="form-control" id="distanciaFotocelda2">
                            </div>
                            <div class="col-md-3">
                                <label for="fotocelda2Ancho" class="form-label">Fotocelda 2 Ancho (mm)</label>
                                <input type="number" class="form-control" id="fotocelda2Ancho">
                            </div>
                            <div class="col-md-3">
                                <label for="fotocelda2Alto" class="form-label">Fotocelda 2 Alto (mm)</label>
                                <input type="number" class="form-control" id="fotocelda2Alto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="posicionFotocelda2" class="form-label">Posición Fotocelda 2</label>
                                <select class="form-select" id="posicionFotocelda2">
                                    <option value="izquierda">Izquierda</option>
                                    <option value="derecha">Derecha</option>
                                    <option value="centro">Centro</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                </div>
                <!-- End of Content -->

            </div>
            <!-- End of Main Content -->

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
