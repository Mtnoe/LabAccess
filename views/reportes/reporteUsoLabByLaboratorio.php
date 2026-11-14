<?php
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/ReporteController.php");

$ReporteController = new ReporteController();
$resultado = $ReporteController->reporteUsoLabPerLaboratorio($_GET["periodo"]);
$totalPracticas = 0;
$totalAlumnos = 0;
$totalHoras = 0;
$control = 6;
?>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="btnExportar" class=" btn btn-success" onclick="Exportar()">
                        <i class="fa fa-file"></i>&nbsp;Exportar a Excel </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dtListadoReporte" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th colspan="5">Periodo: <?php  echo $_GET["periodonombre"]; ?></th>
                        </tr>
                        <tr>
                            <th>Laboratorio</th>
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
                            if($row["id"]==6){
                                ?>
                                <tr>
                                    <td><?php echo $row["laboratorio"]; ?></td>
                                    <td><?php echo $row["carrera"]; ?></td>
                                    <td><?php echo $row["totalPracticas"];
                                            $totalPracticas += $row["totalPracticas"]; ?></td>
                                    <td><?php echo $row["tiempo"];
                                            $totalHoras += $row["tiempo"]; ?></td>
                                    <td><?php echo $row["cantAlumnos"];
                                            $totalAlumnos += $row["cantAlumnos"]; ?></td>
                                </tr>
                                <?php
                            }else{
                                ?>
                                <tr>
                                    <td></td>
                                    <td>TOTAL</td>
                                    <td><?php echo $totalPracticas; ?></td>
                                    <td><?php echo $totalHoras; ?></td>
                                    <td><?php echo $totalAlumnos; ?></td>
                                </tr>
                                <?php
                                $totalPracticas = 0;
                                $totalAlumnos = 0;
                                $totalHoras = 0;
                                $control = $row["id"];
                                ?>
                                <tr>
                                    <td><?php echo $row["laboratorio"]; ?></td>
                                    <td><?php echo $row["carrera"]; ?></td>
                                    <td><?php echo $row["totalPracticas"];
                                        $totalPracticas += $row["usoLab"]; ?></td>
                                    <td><?php echo $row["tiempo"];
                                        $totalHoras += $row["tiempo"]; ?></td>
                                    <td><?php echo $row["cantAlumnos"];
                                        $totalAlumnos += $row["cantAlumnos"]; ?></td>
                                </tr>
                                <?php
                            }
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
                            <td></td>
                            <td>TOTAL:</td>
                            <td><?php echo $totalPracticas; ?></td>
                            <td><?php echo $totalHoras; ?></td>
                            <td><?php echo $totalAlumnos; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

<script>

    function Exportar(){
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

        var table = 'dtListadoReporte';
        var name = 'Reporte Por Laboratorio';

        if (!table.nodeType) table = document.getElementById(table)
        var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
        window.location.href = uri + base64(format(template, ctx))
    }
</script>