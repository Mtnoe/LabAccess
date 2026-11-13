<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/usuarioController.php");

$perfilid = $_SESSION["usuarioPerfil"];
$usuarioId = $_SESSION["usuarioId"];
//$tipoSesion = 2;
//if($perfilid==4){$tipoSesion=1;}

$UsuarioController = new usuarioController();
$resultado = $UsuarioController->consultarTodosUsuarios();

?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<section class="container-fluid">
    <br>
    <div class="card">
        <h4 class="card-header">
            <div class="row">
                <div class="col-sm-6" >
                    <h4>Listado de Usuarios</h4>
                </div>
                <div class="col-sm-6 text-right" >
                    <a href="#" class="btn btn-primary"
                       onclick="CargarPagina('main','views/personales/personalesMod.php')">
                        <i class="fa fa-plus"></i>&nbsp;Agregar
                    </a>
                </div>
            </div>
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dtListadoUsuarios" class="table table-striped table-bordered small">
                    <thead>
                    <tr>
                        <th>No. Empleado</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($resultado->num_rows >0) {
                        while ($row = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["usuario"]; ?></td>
                                <td><?php echo $row["nombreCompleto"]; ?></td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <button type="button" class="btn btn-outline-success"
                                                onclick="visualizarUsuario('<?php echo base64_encode($row["usuarioid"]); ?>')">
                                            <i class="fa fa-user-edit"></i>&nbsp;Modificar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td colspan="8" style="text-align: center"><h1>No Existen Usuarios Para Mostrar</h1></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
        gridTabla('dtListadoUsuarios',4);
    });

    function visualizarUsuario(info) {
        CargarPagina('main','views/personales/personalesMod.php?usuario='+ info);
    }

</script>