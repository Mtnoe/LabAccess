<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Personal
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link"
               onclick="CargarPagina('main','views/personales/personalesMod.php?usuario=<?php echo base64_encode($_SESSION["usuarioId"]); ?>')">
                <i class="far fa-circle nav-icon"></i>
                <p>Datos Personales</p>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Eventos
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="CargarPagina('main','views/eventos/capturaevento.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" class="nav-link" onclick="CargarPagina('main','views/eventos/tablalistadoeventos.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Listado</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Administraci&oacute;n
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cerrar Sesi&oacute;n</p>
            </a>
        </li>
    </ul>
</li>
