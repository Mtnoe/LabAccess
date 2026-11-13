<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/AdmonController.php");

$AdmonController = new AdmonController();
$resultado = $AdmonController->obtenerMaterias();

?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<section class="container-fluid">
    <br>
    <div class="card">
        <h4 class="card-header">
            <div class="row">
                <div class="col-sm-6" >
                    <h4>Listado de Materias</h4>
                </div>
                <div class="col-sm-6 text-right" >
                    <a href="#" class="btn btn-primary"
                       onclick="CargarPagina('main','views/materias/materiasDatos.php')">
                        <i class="fa fa-plus"></i>&nbsp;Agregar
                    </a>
                </div>
            </div>
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dtListadoMaterias" class="table table-striped table-bordered small">
                    <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Programa <br> Educativo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($resultado->num_rows >0) {
                        while ($row = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["matClavle"]; ?></td>
                                <td><?php echo $row["carrera"]; ?></td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <button type="button" class="btn btn-outline-success"
                                                onclick="visualizarMateria('<?php echo base64_encode($row["id"]); ?>')">
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
                            <td colspan="8" style="text-align: center"><h1>No Existen Materias Para Mostrar</h1></td>
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
        gridTabla('dtListadoMaterias',2);
    });

    function visualizarMateria(info) {
        CargarPagina('main','views/materias/materiasDatos.php?materia='+ info);
    }

</script>