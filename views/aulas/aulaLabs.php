<?php
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/model/aulas.php");


$aula = new aulas();
$plantelId = isset($_GET['plantel']) ? (int)$_GET['plantel'] : 0;

// aqui se usa el metodo de la clase aultas para consultar los laboratorios por plantel
$resultado = $aula->consultarLaboratoriosByPlantel($plantelId);

// planteles para el filtro
$conexionPorPlanteles = new conexion();
$conexionPorPlanteles->query = "SELECT id, Plantel FROM " . $conexionPorPlanteles->nombreBD . ".plantel ORDER BY Plantel ASC";
$resPlanteles = $conexionPorPlanteles->consultarDatos();


?>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-0">Laboratorios</h4>
            </div>
            <div class="col-md-6 text-right">
                <label for="cbPlantel" class="mr-2 mb-0">Plantel:</label>
                <select name="cbPlantel" id="cbPlantel" class="form-control d-inline-block" style="width: auto; min-width: 220px"
                        onchange="filtrarPorPlantel(this.value)">
                        <option value="0" <?php echo ($plantelId === 0) ? 'selected' : ''; ?>>Todos los planteles</option>
                        <?php
                        if ($resPlanteles && $resPlanteles->num_rows > 0){
                            while($p = $resPlanteles->fetch_assoc()){
                                $sel = ((int) $p['id'] === $plantelId) ? 'selected' : '';
                                echo '<option value="' . (int)$p['id'] . '" ' . $sel . '>' .htmlspecialchars($p['Plantel'], ENT_QUOTES, 'UTF-8') . '</option>';
                            }
                        }
                        ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id = "dtlistaLabs" class="table table-bordered table-striped" style= "width:100%">
            <thead>
                <tr>
                    <th>Nombre del Laboratorio</th>
                    <th>Nombre del Edificio</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($resultado && $resultado->num_rows > 0){
                    while($row = $resultado->fetch_assoc()){
                        $estaActivo = ((int)($row["activo"] ?? 0) === 1);
                        $nombreLab = $row["nombre"] ?? '';
                        $nombreEdif = !empty($row["edificionombre"])
                            ? $row["edificionombre"]
                            : ("Edificio #" . ($row["edificioid"] ?? ''));
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($nombreLab, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($nombreEdif, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if($estaActivo): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Inactivo</span>
                                <?php endif; ?>
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

<script>
    $(function () {
        gridTabla('dtlistaLabs', 0);
    });

    function filtrarPorPlantel(plantelId) {
        CargarPagina('main', 'views/aulas/aulaLabs.php?plantel=' + encodeURIComponent(plantelId));
    }
</script>