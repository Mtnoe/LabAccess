<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/GeneralController.php");
$GeneralController = new GeneralController();
$tipoReporte = $_GET["type"];
//1 -> reporte por Labortatorio
//2 -> reporte por carrera
?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<section class="container-fluid">
    <br>
    <div class="card">
        <h4 class="card-header">
            <div class="row">
                <div class="col-sm-12" >
                    <h4>Selecci&oacute;n Periodo</h4>
                </div>
            </div>
        </h4>
        <div class="card-body" >
            <div class="row">
                <div class="col-sm-3 text-right" >
                    <label>Selecci&oacute;n Periodo:</label>
                </div>
                <div class="col-sm-5" >
                    <select id="cbPeriodo" class="form-control">
                        <?php
                            echo $GeneralController->obtenerPeriodos(-1);
                        ?>
                    </select>
                </div>
                <div class="col-sm-4" >
                    <a href="#" class="btn btn-success" onclick="visualizarReporte()">Generar</a>
                </div>

            </div>
            <div class="row">
                <hr class="bg-black">
            </div>
            <div class="row" id="dataReporte">

            </div>
        </div>
    </div>
</section>
<script>
    function visualizarReporte() {
        <?php
        switch ($tipoReporte) {
            case 1:
                ?>
                CargarPagina('dataReporte','views/reportes/reporteUsoLabByLaboratorio.php?periodo='+ $("#cbPeriodo").val()+'&periodonombre='+encodeURI($("#cbPeriodo").find('option:selected').text()));
                <?php
                break;
            case 2:
                ?>
                CargarPagina('dataReporte','views/reportes/reporteUsoLabByCarrera.php?periodo='+ $("#cbPeriodo").val()+'&periodonombre='+ encodeURI($("#cbPeriodo").find('option:selected').text()));
                <?php
                break;
        }
        ?>

    }

</script>