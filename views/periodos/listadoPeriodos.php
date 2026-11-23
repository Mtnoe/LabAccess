<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/AdmonController.php");

$AdmonController = new AdmonController();
$resultado = $AdmonController->obtenerPeriodos();

?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<section class="container-fluid">
    <br>
    <div class="card">
        <h4 class="card-header">
            <div class="row">
                <div class="col-sm-6" >
                    <h4>Listado de Periodos</h4>
                </div>
                <div class="col-sm-6 text-right" >
                    <a href="#" class="btn btn-primary"
                        onclick="CargarPagina('main','views/periodos/periodosDatos.php')">
                        <i class="fa fa-plus"></i>&nbsp;Agregar
                    </a>
                </div>
            </div>
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dtListadoPeriodos" class="table table-striped table-bordered small">
                    <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>A&ntilde;o</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($resultado && $resultado->num_rows > 0) {
                            $anioActual = (int)date('Y');
                            while ($row = $resultado->fetch_assoc()) {
                                $anioPeriodo = (int)$row["anio"];
                                $esAnterior = ($anioPeriodo < $anioActual);
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["nombre"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo $anioPeriodo; ?></td>
                                    <td><?php echo htmlspecialchars($row["estado"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <?php if ($esAnterior): ?>
                                                <button type="button" class="btn btn-outline-secondary" disabled title="No se pueden modificar periodos anteriores al año actual">
                                                    <i class="fa fa-user-edit"></i>&nbsp;Modificar
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-outline-success"
                                                        onclick="visualizarPeriodo('<?php echo base64_encode($row["id"]); ?>')">
                                                    <i class="fa fa-user-edit"></i>&nbsp;Modificar
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
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
        gridTabla('dtListadoPeriodos',2);
    });

    function visualizarPeriodo(info) {
        CargarPagina('main','views/periodos/periodosDatos.php?periodo='+ info);
    }

</script>