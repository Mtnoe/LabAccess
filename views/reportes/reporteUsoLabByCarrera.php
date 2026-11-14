<?php
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/ReporteController.php");

$ReporteController = new ReporteController();
$resultado = $ReporteController->reporteUsoLabPerCarrera($_GET["periodo"]);
$totalPracticas = 0;
$totalAlumnos = 0;
$totalHoras = 0;
?>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="btnExportar" class=" btn btn-success" onclick="exportTableToExcel('dtListadoReporte','reporteByCarrera.xls')">
                        <i class="fa fa-file"></i>&nbsp;Exportar a Excel </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtListadoReporte" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th colspan="4">Periodo: <?php  echo $_GET["periodonombre"]; ?></th>
                        </tr>
                        <tr>
                            <th>Carrera</th>
                            <th>Pr&aacute;cticas<br>Realizadas</th>
                            <th>Horas Pr&aacute;ctica</th>
                            <th>Estudiantes Atendidos</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($resultado->num_rows >0) {
                        while ($row = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["nombre"]; ?></td>
                                <td><?php echo $row["usoLab"];
                                        $totalPracticas += $row["usoLab"]; ?></td>
                                <td><?php echo $row["usoHoras"];
                                        $totalHoras += $row["usoHoras"]; ?></td>
                                <td><?php echo $row["usoAlumnos"];
                                        $totalAlumnos += $row["usoAlumnos"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td colspan="8" style="text-align: center"><h1>No Existen Datos Para Mostrar</h1></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>TOTAL:</td>
                            <td><?php echo $totalPracticas; ?></td>
                            <td><?php echo $totalHoras; ?></td>
                            <td><?php echo $totalAlumnos; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

