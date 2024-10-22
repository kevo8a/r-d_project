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

    <!-- Formulario 1 -->
    <?php if ($role == 1 || $role == 2 || $role == 3): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm1" aria-expanded="true" aria-controls="collapseForm1">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Formulario 1</span>
        </a>
        <div id="collapseForm1" class="collapse" aria-labelledby="headingForm1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Formularios:</h6>
                <a class="collapse-item" href="/r&d/html/forms/form1_create_edit.php">Crear Formulario</a>
                <a class="collapse-item" href="/r&d/html/forms/form1_list.php">Ver mis forms 1</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Formulario 2 -->
    <?php if ($role == 1 || $role == 2 || $role == 3): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm2" aria-expanded="true" aria-controls="collapseForm2">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Formulario 2</span>
        </a>
        <div id="collapseForm2" class="collapse" aria-labelledby="headingForm2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Formularios:</h6>
                <a class="collapse-item" href="/r&d/html/forms/form1_list.php">Ver mis forms 2</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Formulario 3 -->
    <?php if ($role == 1 || $role == 2 || $role == 3): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm3" aria-expanded="true" aria-controls="collapseForm3">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Formulario 3</span>
        </a>
        <div id="collapseForm3" class="collapse" aria-labelledby="headingForm3" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Formularios:</h6>
                <a class="collapse-item" href="/r&d/html/form1_create_edit.php">Crear Formulario 3</a>
                <a class="collapse-item" href="/r&d/html/forms/form1_list.php">Ver mis forms 3</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Formulario 4 -->
    <?php if ($role == 1 || $role == 2 || $role == 3): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm4" aria-expanded="true" aria-controls="collapseForm4">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Formulario 4</span>
        </a>
        <div id="collapseForm4" class="collapse" aria-labelledby="headingForm4" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Formularios:</h6>
                <a class="collapse-item" href="/r&d/html/forms/form1_list.php">Ver mis forms 4</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Ver Todos los Forms (Solo rol 1 y 2) -->
    <?php if ($role == 1 || $role == 2): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAllForms" aria-expanded="true" aria-controls="collapseAllForms">
            <i class="fas fa-fw fa-user"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseAllForms" class="collapse" aria-labelledby="headingAllForms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Validacion de Forms:</h6>
                <a class="collapse-item" href="/r&d/html/usuarios/forms1_show_all.php">Ver Forms 1</a>
                <a class="collapse-item" href="/r&d/html/usuarios/forms2_show_all.php">Ver Forms 2</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Opciones de Usuarios (Solo rol 1) -->
    <?php if ($role == 1): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-user"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones de Usuarios:</h6>
                <a class="collapse-item" href="/r&d/html/usuarios/crear_cuenta.php">Crear Usuario</a>
                <a class="collapse-item" href="/r&d/html/usuarios/editar_cuenta.php">Editar Usuario</a>
            </div>
        </div>
    </li>
    <?php endif; ?>
</ul>
<!-- End of Sidebar -->
