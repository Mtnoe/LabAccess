<?php
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/AdmonController.php");

$AdmonController = new AdmonController();

if(isset($_REQUEST["periodo"])) {
    $periodoId = base64_decode($_REQUEST["periodo"]);
    $AdmonController->obtenerPeriodoById($periodoId);
}else{
    $periodoId = 0;
}
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Periodos</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formPeriodos" name="formPeriodos">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbPeriodo">Periodo</label>
                                <select id="cbPeriodo" name="cbPeriodo" class="form-control">
                                    <option value="Enero-Mayo">Enero-Mayo</option>
                                    <option value="Agosto-Diciembre">Agosto-Diciembre</option>
                                </select>
                                <input id="periodoId" name="periodoId" type="hidden" value="<?php echo base64_encode($periodoId); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbAnio">A&ntilde;o</label>
                                <select id="cbAnio" name="cbAnio" class="form-control">
                                    <?php
                                        $datos = "";
                                        for($i=date(Y);$i<=date(Y)+2;$i++) {
                                            $datos .= "<option value='" . $i . "'>" . $i . "</option>";
                                        }
                                        echo $datos;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="ElementoEstatus">
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
                    <button type="button" class="btn btn-danger" onclick="CargarPagina('main','views/periodos/listadoPeriodos.php')"><i class="fa fa-arrow-left"></i>&nbsp;Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/validator.js" type="text/javascript"></script>
<script type="text/javascript">
    function modificarPeriodo() {
        var datos = $('#formPeriodos').serialize() + '&operacion=registrarPeriodo';
        $.post("controller/AdmonController.php", datos, function (data) {
            if (data.resultado === 'success') {
                mostrarMensaje("Periodos",data.resultado, "Operaci&oacute;n realizada con &eacute;xito.");
                CargarPagina('main','views/periodos/listadoPeriodos.php');
            } else {
                mostrarMensaje("Periodos",data.resultado, data.mensaje);
            }
        }, 'json');
    }

    function validarFormularioPeriodos() {
        $('#formPeriodos').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                    modificarPeriodo();
            }
        });
    }

    $(document).ready(function() {
        validarFormularioPeriodos();

        <?php
        if($periodoId>0){
            ?>
            $('#cbPeriodo').val('<?php echo $AdmonController->objPeriodo->nombre; ?>');
            $('#cbAnio').val('<?php echo $AdmonController->objPeriodo->anio; ?>');
            $('#cbActivo').val('<?php echo $AdmonController->objPeriodo->activo; ?>');
            <?php
        }else{
            ?>
            $('#ElementoEstatus').css("display", "none");
            <?php
        }
        ?>
    });
</script>