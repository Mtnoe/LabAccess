<?php
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/GeneralController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/AdmonController.php");

$AdmonController = new AdmonController();
$GeneralController = new GeneralController();

if(isset($_REQUEST["materia"])) {
    $materiaId = base64_decode($_REQUEST["materia"]);
    $AdmonController->obtenerMateriaById($materiaId);
}else{
    $materiaId = 0;
}
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Materias</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formMaterias" name="formMaterias">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtClaveMat">Clave Materia</label>
                                <input type="text" class="form-control" id="txtClaveMat" name="txtClaveMat" placeholder="Ingrese la clave de materia" maxlength="20" value="<?php echo $AdmonController->objMateria->clave; ?>" required>
                                <div class="help-block with-errors"></div>
                                <input id="materiaId" name="materiaId" type="hidden" value="<?php echo base64_encode($materiaId); ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="txtNombreMat">Nombre de Materia</label>
                                <input type="text" class="form-control" id="txtNombreMat" name="txtNombreMat" placeholder="Ingrese el nombre de materia" maxlength="200" value="<?php echo $AdmonController->objMateria->nombre; ?>"  required>
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-edit"></i>&nbsp;Guardar </button>
                    <button type="button" class="btn btn-danger" onclick="CargarPagina('main','views/materias/listadoMaterias.php')"><i class="fa fa-arrow-left"></i>&nbsp;Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/validator.js" type="text/javascript"></script>
<script type="text/javascript">
    function modificarMaterias() {
        var datos = $('#formMaterias').serialize() + '&operacion=registrarMateria';
        $.post("controller/AdmonController.php", datos, function (data) {
            if (data.resultado === 'success') {
                mostrarMensaje("Materias",data.resultado, "Operaci&oacute;n realizada con &eacute;xito.");
                CargarPagina('main','views/materias/listadoMaterias.php');
            } else {
                mostrarMensaje("Materias",data.resultado, data.mensaje);
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
        validarFormularioMaterias();

        <?php
        if($materiaId>0){
            ?>
            $('#cbCarrera').val('<?php echo $AdmonController->objMateria->idcarrera; ?>');
            $('#cbActivo').val('<?php echo $AdmonController->objMateria->activo; ?>');
            <?php
        }
        ?>
    });
</script>