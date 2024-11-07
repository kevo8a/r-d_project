<div class="mb-3">
                                    <label for="solicitante" class="form-label">Solicitante </label>
                                    <input type="text" class="form-control" id="solicitante" name="solicitante" value="<?php echo htmlspecialchars($form_data['name_user'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="site" class="form-label">Site </label>
                                    <input type="text" class="form-control" id="site" name="site" value="<?php echo htmlspecialchars($form_data['site_user'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario </label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo htmlspecialchars($form_data['id_user'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="qualified_by" class="form-label">Calificado por </label>
                                    <input type="text" class="form-control" id="qualified_by" name="qualified_by" value="<?php echo htmlspecialchars($form_data['qualified_by'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Fecha de creación</label>
                                    <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo htmlspecialchars($form_data['created_at'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="completed_at" class="form-label">Fecha de finalización</label>
                                    <input type="text" class="form-control" id="completed_at" name="completed_at" value="<?php echo htmlspecialchars($form_data['completed_at'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="client" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="client" name="client" value="<?php echo htmlspecialchars($form_data['name_client'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Estatus</label>
                                    <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($form_data['status_form2'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="project_name" class="form-label">Nombre del Proyecto/Producto</label>
                                    <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo htmlspecialchars($form_data['project_name'] ?? ''); ?>">
                                </div>