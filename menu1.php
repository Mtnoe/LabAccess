<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 12/02/2022
 * Time: 10:52
 */

?>
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
               onclick="CargarPagina('main','views/personales/listadoUsuarios.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Datos Personales</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Administraci&oacute;n
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link"
               onclick="CargarPagina('main','views/periodos/listadoPeriodos.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Periodos</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"
               onclick="CargarPagina('main','views/materias/listadoMaterias.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Materias</p>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-edit"></i>
        <p>
            Registro
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link" class="nav-link" onclick="CargarPagina('main','views/registroUsoLabs/registro.php')">
                <i class="far fa-circle nav-icon"></i>
                <p>Uso Lab</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
            Reportes
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="CargarPagina('main','views/reportes/seleccionPeriodo.php?type=1')">
                <i class="far fa-circle nav-icon"></i>
                <p>Por Laboratorio</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="CargarPagina('main','views/reportes/seleccionPeriodo.php?type=2')">
                <i class="far fa-circle nav-icon"></i>
                <p>Por Carrera</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Finalizaci&oacute;n
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
