function consultarMunicipios(municipio) {
    $.post( "controller/baseController.php",
        {estado:$("#cbEstado").val(),seleccion:municipio,operacion:'municipio'},
        function(data) {
            $("#municipios").html(data);
        });
}

function CargarPagina(div,ruta) {
    $("#"+div).load(ruta);
}

function gridTabla($tablaid, $ordercolumn) {
    var table = $('#' + $tablaid).DataTable({
        "pageLength": 10,
        "lengthMenu": [[10, 50, 100, 1000, -1], [10, 50, 100, 1000, "Todos"]],
        //"dom": "<'col-xs-12'<'pull-left'l><'pull-right'f>><'col-xs-12 table-responsive'tr><'col-xs-12 clearfix'ip>",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
        }
    });
    if ($ordercolumn)
        table.order([[$ordercolumn, "asc"]]).draw();
}

function mostrarMensaje(titulo, tipo, mensaje) {
    var $title = titulo;
    var dialog = BootstrapDialog.show({
        title: $title,
        message: mensaje,
        size: BootstrapDialog.SIZE_WIDE,
        type: (tipo === "success") ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_WARNING,
        buttons: [{
            label: '<i class="fa fa-close"></i> Cerrar',
            cssClass: 'btn-default',
            action: function () {
                $.each(BootstrapDialog.dialogs, function (id, dialog) {
                    dialog.close();
                });
            }
        }]
    });
    dialog.setClosable(false);
}


/*metodo que solo permite letras y numeros
 type 1 Solo permite letras y numeros
 type 2 admite letras, numeros, acentos,   y espacios
 type 3 admite letras, numeros y @
 */
function onlyAlphaNumerics(nameinput, type) {

    $("#" + nameinput).keypress(function (e) {
        if (type == 1) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
                return false;
            }
        }
        if (type == 2) {
            if (e.which != 8 && e.which != 0 && e.which != 32 && e.which != 241 && e.which != 209 && e.which != 225 &&
                e.which != 233 && e.which != 237 && e.which != 243 && e.which != 250 && e.which != 193 &&
                e.which != 201 && e.which != 205 && e.which != 211 && e.which != 218 && (e.which < 48 || e.which > 57) &&
                (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
                return false;
            }
        }
        if (type == 3) {
            if (e.which != 8 && e.which != 0 && e.which != 46 && e.which != 45 && e.which != 95 && (e.which < 48 || e.which > 57) && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)) {
                return false;
            }
        }
    });
}

//metodo que impide ingresar letras en un input
function onlyNumbers(arrayinput) {
    var i = 0;
    for (i; i < arrayinput.length; i++) {
        $("#" + arrayinput[i]).keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    }
}

function exportTableToExcel(tableID, filename) {
    // Tipo de exportación
    if (!filename) filename = 'excel_data.xls';
    let dataType = 'application/vnd.ms-excel';

    // Origen de los datos
    let tableSelect = document.getElementById(tableID);
    let tableHTML = tableSelect.outerHTML;

    // Crea el archivo descargable
    let blob = new Blob([tableHTML], {type: dataType});

    // Crea un enlace de descarga en el navegador
    if (window.navigator && window.navigator.msSaveOrOpenBlob) { // Descargar para IExplorer
        window.navigator.msSaveOrOpenBlob(blob, filename);
    } else { // Descargar para Chrome, Firefox, etc.
        let a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";
        let csvUrl = URL.createObjectURL(blob);
        a.href = csvUrl;
        a.download = filename;
        a.click();
        URL.revokeObjectURL(a.href)
        a.remove();
    }
}

