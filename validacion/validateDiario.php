
<?php

    error_reporting(E_ALL);
include_once($_SERVER['DOCUMENT_ROOT']."/accesoEventos/controller/AccesoLibreController.php");

$idAsistenciaLibre = base64_decode($_GET["Lugar"]);
$claveAsistente = base64_decode($_GET["clave"]);
$asistente = base64_decode($_GET["Asistente"]);

$AccesoController = new AccesoLibreController();
$AccesoController->consultarAsistenciaLibreById($idAsistenciaLibre);

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Acceso Controlado</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="">
<!-- Site wrapper -->
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid" id="main">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h1>Sistema de Acceso Controlado</h1>
                </div>
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h1 class="card-title text-center" style="width: 100%;">Informaci&oacute;n Del Asistente</h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Clave</label><br>
                                        <label class="text-primary"><?php echo $claveAsistente; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Nombre Completo</label><br>
                                        <label class="text-primary"><?php echo $asistente;?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Plantel De Acceso</label><br>
                                        <label class="text-primary"><?php echo $AccesoController->validateAsistenciaLibre->Plantel; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Departamento</label><br>
                                        <label class="text-primary"><?php echo $AccesoController->validateAsistenciaLibre->Departamento; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Edificio Que Se Dirige</label><br>
                                        <label class="text-primary"><?php echo $AccesoController->validateAsistenciaLibre->Edificio; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="../plugins/bootstrap-dialog/bootstrap-dialog.min.js"></script>
<script type="text/javascript" src="../dist/js/base.js"></script>
<script src="../plugins/validator.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
</body>
</html>
