<form id="form-article" method="POST" enctype="multipart/form-data">
    <div class="row">
        <!-- Características de Calidad de Producto Terminado -->
        <table class="table table-bordered" id="materialTable">
            <thead>
                <tr>
                    <th>Caracteristica</th>
                    <th>Unidad</th>
                    <th>VALOR NOMINAL</th>
                    <th>Tolerancia</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                                        $counter = 1;
                                        $dataCount = count($data);
                                        $rowsToDisplay = max(14, $dataCount); // Asegura que al menos 3 filas se muestren

                                        for ($i = 0; $i < $rowsToDisplay; $i++) {
                                            // Si no hay suficiente datos, se asignan valores vacíos
                                            $item = $i < $dataCount ? $data[$i] : ["feature" => "", "unit" => "", "value" => "", "tolerance" => "", "notes" => ""];

                                            echo '<tr>';
                                            echo '<td><input type="text" name="feature'  . $counter . '" class="form-control" value="' . htmlspecialchars($item["feature"  ]) . '" readonly ></td>';
                                            echo '<td><input type="text" name="unit'     . $counter . '" class="form-control" value="' . htmlspecialchars($item["unit"     ]) . '" readonly></td>';
                                            echo '<td><input type="text" name="value'    . $counter . '" class="form-control" value="' . htmlspecialchars($item["value"    ]) . '" ></td>';
                                            echo '<td><input type="text" name="tolerance'. $counter . '" class="form-control" value="' . htmlspecialchars($item["tolerance"]) . '" ></td>';
                                            echo '<td><input type="text" name="notes'    . $counter . '" class="form-control" value="' . htmlspecialchars($item["notes"    ]) . '" ></td>';
                                            echo '</tr>';
                                            $counter++;
                                        }
                                    ?>
            </tbody>
        </table>
        <div>
            <!-- Cambiar type a "button" para evitar conflicto con el envío del formulario -->
            <button id="addRowBtn" type="button" class="btn btn-success">Agregar Fila</button>
            <button id="removeRowBtn" type="button" class="btn btn-danger">Eliminar Fila</button>
        </div>
        <div class="col-md-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    $('#form-article').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío normal del formulario

        var formData = new FormData(this); // Crear FormData con los datos del formulario

        // Ver los datos que estamos enviando con AJAX
        for (var pair of formData.entries()) {
            console.log(pair[0] + ": " + pair[1]);
        }

        $.ajax({
            url: '../../php/update_form4.php?id=' +
                <?php echo $_GET['id']; ?>, // Asegúrate de que el ID esté en la URL
            type: 'POST',
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el tipo de contenido
            success: function(response) {
                var result = JSON.parse(response); // Parsear la respuesta del servidor
                if (result.success) {
                    alert(result.message); // Mostrar mensaje de éxito
                    window.location.href =
                        '/r&d/html/index.php'; // Redirigir después de éxito
                } else {
                    alert(result.message); // Mostrar mensaje de error
                }
            },
            error: function(xhr, status, error) {
                alert("Hubo un error en la comunicación con el servidor.");
            }
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("tableBody");
    const addRowBtn = document.getElementById("addRowBtn");
    const removeRowBtn = document.getElementById("removeRowBtn");

    // Función para agregar una nueva fila
    addRowBtn.addEventListener("click", () => {
        const rowCount = tableBody.rows.length + 1; // Sumar una fila nueva
        const newRow = document.createElement("tr");

        newRow.innerHTML = `
                <td><input type="text" name="feature${rowCount}" class="form-control" value=""></td>
                <td><input type="text" name="unit${rowCount}" class="form-control" value=""></td>
                <td><input type="text" name="value${rowCount}" class="form-control" value=""></td>
                <td><input type="text" name="tolerance${rowCount}" class="form-control" value=""></td>
                <td><input type="text" name="notes${rowCount}" class="form-control" value=""></td>
            `;
        tableBody.appendChild(newRow);
    });

    // Función para eliminar la última fila
    removeRowBtn.addEventListener("click", () => {
        if (tableBody.rows.length > 0) {
            tableBody.deleteRow(-1); // Elimina la última fila
        }
    });
});
</script>