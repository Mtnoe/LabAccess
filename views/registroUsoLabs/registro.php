<?php

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/controller/GeneralController.php");
$generalController = new GeneralController();

?>
<link rel="stylesheet" href="plugins/select2/css/select2.css" >
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registro uso de laboratorio</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formRegistroLab" name="formRegistroLab">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txtUsuario">Clave Docente</label>
                                <input type="number" class="form-control number" id="txtUsuario" name="txtUsuario" placeholder="Ingrese su nombre" maxlength="4" min="1" max="9999" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txtFecha">Fecha de Sesi&oacute;n</label>
                                <input type="text" class="form-control" id="txtFecha" name="txtFecha" placeholder="Ingrese su " value="<?php echo date("d/m/Y"); ?>" maxlength="100" disabled>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cbHoraEntrada">Hora Entrada</label>
                                <select id="cbHoraEntrada" name="cbHoraEntrada" class="form-control select2">
                                    <?php
                                        echo $generalController->obtenerHorarios(7,19);
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cbHoraSalida">Hora Salida</label>
                                <select id="cbHoraSalida" name="cbHoraSalida" class="form-control select2">
                                    <?php
                                    echo $generalController->obtenerHorarios(8,20);
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbCarrera">Selecciona la Carrera</label>
                                <select class="form-control select2" id="cbCarrera" name="cbCarrera" onchange="cargarMaterias()" required>
                                    <?php
                                    echo $generalController->obtenerCarreras();
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbMateria">Selecciona la Materia</label>
                                <select class="select2 form-control " id="cbMateria" name="cbMateria" required>

                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbLaboratorio">Selecciona el Laboratorio</label>
                                <select class="select2 form-control " id="cbLaboratorio" name="cbLaboratorio" required>
                                    <?php
                                     echo $generalController->obtenerLaboratorios();
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cbPeriodo">Periodo</label>
                                <select class="form-control" id="cbPeriodo" name="cbPeriodo" required>
                                    <?php
                                    echo $generalController->obtenerPeriodos(1);
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txtCantAlumnos">Cantidad de Alumnos</label>
                                <input type="number" class="form-control number" id="txtCantAlumnos" name="txtCantAlumnos" placeholder="Ingrese un n&uacute;mero" maxlength="2" min="1" max="80" value="" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtPractica">Nombre de la Pr&aacute;ctica</label>
                                <input type="text" class="form-control" id="txtPractica" name="txtPractica" placeholder="Ingrese el nombre de la pr&aacute;ctica" maxlength="200" value="" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-danger" onclick="borrarRegistro()"><i class="fa fa-times"></i>&nbsp;Borrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Registrar Bit&aacute;cora</button>

                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/validator.js" type="text/javascript"></script>

<script src="plugins/select2/js/select2.full.js" type="text/javascript"></script>
<script type="text/javascript">

    $(".number").on('input', function() {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
            $this.val(value.slice(0, maxlength));

        }
    });

    function cargarMaterias() {
        var datos = 'carrera='+ $("#cbCarrera").val() + '&operacion=consultarMaterias';
        $.post("controller/GeneralController.php", datos, function (data) {
            $("#cbMateria").html(data);
        });

    }

    function borrarRegistro(){
        $("#txtUsuario").val("");
        $("#txtPractica").val("");
        $("#txtCantAlumnos").val("");
        $("#cbHoraEntrada").val("7");
        $("#cbHoraSalida").val("8");
    }


    function RegistrarUsoLab() {
        var datos = $('#formRegistroLab').serialize() + '&operacion=registrarUsoLaboratorio';
        $.post("controller/RegistroLabController.php", datos, function (data) {
            if (data.resultado === 'success') {
                mostrarMensaje("Registro",data.resultado, "Operaci&oacute;n realizada con &eacute;xito.");
                borrarRegistro();
            } else {
                mostrarMensaje("Registro",data.resultado, data.mensaje);
            }
        }, 'json');
    }

    function validarFormularioUsoLab() {
        $('#formRegistroLab').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                RegistrarUsoLab();
            }
        });
    }


    $(document).ready(function() {
        validarFormularioUsoLab();
        cargarMaterias();

        $(".select2").select2();
    });
</script>