<?php
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/GeneralController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/AdmonController.php");

$AdmonController = new AdmonController();
$GeneralController = new GeneralController();

if (!isset($AdmonController->objMateria) || !is_object($AdmonController->objMateria)) {
    $AdmonController->objMateria = new stdClass();
}

$materiaId = 0;
if (isset($_REQUEST["materia"]) && $_REQUEST["materia"] !== "") {
    $rawParam = urldecode($_REQUEST["materia"]);
    $decoded = base64_decode($rawParam, true);
    if ($decoded !== false && is_numeric($decoded)) {
        $materiaId = (int)$decoded;
        $AdmonController->obtenerMateriaById($materiaId);
    }
}

$claveVal   = $AdmonController->objMateria->clave ?? $AdmonController->objMateria->matClavle ?? '';
$nombreVal  = $AdmonController->objMateria->nombre ?? '';
$carreraVal = $AdmonController->objMateria->idcarrera ?? $AdmonController->objMateria->id_carrera ?? '';
$activoVal  = isset($AdmonController->objMateria->activo) ? (string)$AdmonController->objMateria->activo : '1';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Materias</h3>
            </div>
            <form role="form" id="formMaterias" name="formMaterias">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtClaveMat">Clave Materia</label>
                                <input type="text"
                                       class="form-control text-uppercase"
                                       id="txtClaveMat"
                                       name="txtClaveMat"
                                       placeholder="Ej. ACF1394"
                                       maxlength="8"
                                       pattern="^[A-Za-z]{3,4}[0-9]{4}$"
                                       data-pattern-error="La clave debe tener de 3 a 4 letras seguidas de 4 números."
                                       value="<?php echo htmlspecialchars($claveVal, ENT_QUOTES, 'UTF-8'); ?>"
                                       required>
                                <div class="help-block with-errors"></div>
                                <input id="materiaId" name="materiaId" type="hidden" value="<?php echo base64_encode((string)$materiaId); ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="txtNombreMat">Nombre de Materia</label>
                                <input type="text"
                                       class="form-control"
                                       id="txtNombreMat"
                                       name="txtNombreMat"
                                       placeholder="Ingrese el nombre de materia"
                                       maxlength="200"
                                       value="<?php echo htmlspecialchars($nombreVal, ENT_QUOTES, 'UTF-8'); ?>"
                                       required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="cbCarrera">Programa Educativo</label>
                                <select id="cbCarrera" name="cbCarrera" class="form-control">
                                   <?php
                                       echo $GeneralController->obtenerCarreras();
                                   ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbActivo">Estatus</label>
                                <select id="cbActivo" name="cbActivo" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Cerrado</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-edit"></i>&nbsp;Guardar</button>
                    <button type="button" class="btn btn-danger" onclick="CargarPagina('main','views/materias/listadoMaterias.php')"><i class="fa fa-arrow-left"></i>&nbsp;Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/validator.js" type="text/javascript"></script>
<script type="text/javascript">
    function modificarMaterias() {
        var $claveInput = $('#txtClaveMat');
        $claveInput.val($claveInput.val().trim().toUpperCase());

        var datos = $('#formMaterias').serialize() + '&operacion=registrarMateria';
        $.post("controller/AdmonController.php", datos, function (data) {
            if (data.resultado === 'success') {
                mostrarMensaje("Materias", data.resultado, "Operación realizada con éxito.");
                CargarPagina('main', 'views/materias/listadoMaterias.php');
            } else {
                mostrarMensaje("Materias", data.resultado, data.mensaje);
            }
        }, 'json');
    }

    function validarFormularioMaterias() {
        $('#formMaterias').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                modificarMaterias();
            }
        });
    }

    $(document).ready(function() {
        $('#txtClaveMat').on('input', function () {
            this.value = this.value.toUpperCase();
        });

        validarFormularioMaterias();

        var materiaId = <?php echo (int)$materiaId; ?>;
        var carreraId = <?php echo json_encode((string)$carreraVal); ?>;
        var activoVal = <?php echo json_encode((string)$activoVal); ?>;

        if (materiaId > 0) {
            if (carreraId !== '') {
                $('#cbCarrera').val(carreraId).trigger('change');
            }
            if (activoVal !== '') {
                $('#cbActivo').val(activoVal).trigger('change');
            }
        }
    });
</script>