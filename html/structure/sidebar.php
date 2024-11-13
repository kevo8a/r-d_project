<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/r&d/html/index.php">
        <div class="sidebar-brand-icon" style="margin-left: -20px;">
            <img src="/r&d/img/logo_amcor1.png" alt="Amcor Logo" class="amcor-logo" width="190" height="auto">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>
    <!-- Menú Forms -->
    <?php if ($role == 1 || $role == 2 || $role == 3): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true"
            aria-controls="collapseForms">
            <i class="fas fa-fw fa-folder"></i>
            <span>Mis Forms</span>
        </a>
        <div id="collapseForms" class="collapse" aria-labelledby="headingForms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tipos de Formularios:</h6>

                <!-- Form Cotización -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuForm1"
                    aria-expanded="false" aria-controls="submenuForm1">
                    Form Cotización
                </a>
                <div id="submenuForm1" class="collapse bg-lightblue rounded">
                    <a class="collapse-item text-primary" href="/r&d/html/forms/form1_create_edit.php">Crear
                        Formulario</a>
                    <a class="collapse-item text-primary" href="/r&d/html/forms/form1_list.php">Ver mis forms 1</a>
                </div>

                <!-- Form Diseño Estructura -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuForm2"
                    aria-expanded="false" aria-controls="submenuForm2">
                    Form Diseño Estructura
                </a>
                <div id="submenuForm2" class="collapse bg-lightblue rounded">
                    <a class="collapse-item text-primary" href="/r&d/html/forms/form2_list.php">Ver mis forms 2</a>
                </div>

                <!-- Solicitud Muestra -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuForm3"
                    aria-expanded="false" aria-controls="submenuForm3">
                    Solicitud Muestra
                </a>
                <div id="submenuForm3" class="collapse bg-lightblue rounded">
                    <a class="collapse-item text-primary" href="/r&d/html/forms/form3_create_edit.php">Crear
                        Formulario</a>
                    <a class="collapse-item text-primary" href="/r&d/html/forms/form3_list.php">Ver mis forms 3</a>
                </div>

                <!-- Form Artículo Muestra -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuForm4"
                    aria-expanded="false" aria-controls="submenuForm4">
                    Form Artículo Muestra
                </a>
                <div id="submenuForm4" class="collapse bg-lightblue rounded">
                    <a class="collapse-item text-primary" href="/r&d/html/plantilla.php">Ver mis forms 4</a>
                </div>

            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Ver Todos los Forms (Solo rol 1 y 2) -->
    <?php if ($role == 1 || $role == 2): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAllForms"
            aria-expanded="true" aria-controls="collapseAllForms">
            <i class="fas fa-fw fa-user"></i>
            <span>Approvers</span>
        </a>
        <div id="collapseAllForms" class="collapse" aria-labelledby="headingAllForms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Validacion de Forms:</h6>
                <a class="collapse-item" href="/r&d/html/forms/form1_list_all.php">Ver Forms 1</a>
                <a class="collapse-item" href="/r&d/html/forms/form2_list_all.php">Ver Forms 2</a>
                <a class="collapse-item" href="/r&d/html/forms/form3_list_all.php">Ver Forms 3</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Opciones de Usuarios (Solo rol 1) -->
    <?php if ($role == 1): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true"
            aria-controls="collapseUsers">
            <i class="fas fa-fw fa-user"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Usuarios:</h6>
                <a class="collapse-item" href="/r&d/html/users/form_user.php">Crear Usuario</a>
                <a class="collapse-item" href="/r&d/html/users/user_list.php">Editar Usuario</a>
            </div>
        </div>
    </li>
    <?php endif; ?>
</ul>
<!-- End of Sidebar -->