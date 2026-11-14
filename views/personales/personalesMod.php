<?php
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/usuarioController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/controller/GeneralController.php");
$usuarioController = new usuarioController();
$generalController = new GeneralController();
if(isset($_REQUEST["usuario"])) {
    $usuarioId = base64_decode($_REQUEST["usuario"]);
    $usuarioController->consultarDatosUsuario($usuarioId);
}else{
    $usuarioId = 0;
}
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Usuarios</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formPersonales" name="formPersonales">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtUsuario">Usuario</label>
                                <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Ingrese su nombre" maxlength="150" value="<?php echo $usuarioController->objUsuario->usuario;?>" required >
                                <input id="usuarioId" name="usuarioId" type="hidden" value="<?php echo base64_encode($usuarioId); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtContrasena">Contrase&ntilde;a</label>
                                <input type="password" class="form-control" id="txtContrasena" name="txtContrasena" placeholder="Ingrese su contrase&ntilde;a" maxlength="100" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtConfirmaContrasena">Confirmar Contrase&ntilde;a</label>
                                <input type="password" class="form-control" id="txtConfirmaContrasena" name="txtConfirmaContrasena" placeholder="Confirme su contrase&ntilde;a" maxlength="100" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese su nombre" maxlength="150" value="<?php echo ($usuarioController->objDatosUsuario->nombre);?>" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtPrimerApellido">Primer Apellido</label>
                                <input type="text" class="form-control" id="txtPrimerApellido" name="txtPrimerApellido" placeholder="Ingrese su primer apellido" maxlength="70" value="<?php echo ($usuarioController->objDatosUsuario->primerapellido);?>" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtSegundoApellido">Segundo Apellido</label>
                                <input type="text" class="form-control" id="txtSegundoApellido" name="txtSegundoApellido" placeholder="Ingrese su segundo apellido" maxlength="70" value="<?php echo ($usuarioController->objDatosUsuario->segundoapellido);?>" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtEmail">Correo Electr&oacute;nico Oficial</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese su correo electr&oacute;nico" maxlength="100" value="<?php echo $usuarioController->objDatosUsuario->correooficial;?>" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbCarrera">Carrera de Adscripci&oacute;n</label>
                                <select class="form-control" id="cbCarrera" name="cbCarrera" required>
                                    <?php
                                        echo $generalController->obtenerCarreras();
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-edit"></i>&nbsp;Actualizar Datos de Usuario</button>
                    <button type="button" class="btn btn-danger" onclick="CargarPagina('main','views/personales/listadoUsuarios.php')"><i class="fa fa-arrow-left"></i>&nbsp;Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/validator.js" type="text/javascript"></script>
<script type="text/javascript">
    function modificarUsuario() {
        var datos = $('#formPersonales').serialize() + '&operacion=<?php if($usuarioId==0)echo "registrarUsuario"; else echo "modificarUsuario"; ?>';
        $.post("controller/usuarioController.php", datos, function (data) {
            if (data.resultado === 'success') {
                mostrarMensaje("Usuarios",data.resultado, "Operaci&oacute;n realizada con &eacute;xito.");
                CargarPagina('main','views/personales/listadoUsuarios.php');
            } else {
                mostrarMensaje("Usuarios",data.resultado, data.mensaje);
            }
        }, 'json');
    }

    function validarFormularioUsuario() {
        $('#formPersonales').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                if($("#txtContrasena").val()==$("#txtConfirmaContrasena").val()) {
                    modificarUsuario();
                }else{
                    mostrarMensaje("Usuarios","error", "Las contraseñas son diferentes, favor de revisar.");
                }
            }
        });
    }

    $(document).ready(function() {
        validarFormularioUsuario();

        <?php
            if($usuarioId>0){
                echo "$('#cbCarrera').val(".$usuarioController->objDatosUsuario->carreraid.")";
            }
        ?>
    });
</script>