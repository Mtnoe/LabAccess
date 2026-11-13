<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 22/02/2019
 * Time: 01:51 PM
 */

function ValidarSesion(){
    if(isset($_SESSION["usuarioId"])) {

    }else{
        ?>
        <br/>
        <table align="center" border="0">
            <tr>
                <td>
                    <h3>No tienes permiso para accesar a esta secci&oacute;n.</h3>
                </td>
            </tr>
        </table>
        <meta http-equiv='refresh' content='2; url=login.php'>
        <?php
        die();
    }
}

function CambiarMesNumeroLetra($numeroMes)
{
    $mesLetra = "";
    switch($numeroMes)
    {
        case 1:
            $mesLetra = "enero";
            break;
        case 2:
            $mesLetra = "febrero";
            break;
        case 3:
            $mesLetra = "marzo";
            break;
        case 4:
            $mesLetra = "abril";
            break;
        case 5:
            $mesLetra = "mayo";
            break;
        case 6:
            $mesLetra = "junio";
            break;
        case 7:
            $mesLetra = "julio";
            break;
        case 8:
            $mesLetra = "agosto";
            break;
        case 9:
            $mesLetra = "septiembre";
            break;
        case 10:
            $mesLetra = "octubre";
            break;
        case 11:
            $mesLetra = "noviembre";
            break;
        case 12:
            $mesLetra = "diciembre";
            break;
    }
    return $mesLetra;
}

function reemplazarCaracteres($cadena)
{
    $string = trim($cadena);
    $string = str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string);

    $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string);

    $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string);

    $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string);

    $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string);

    $string = str_replace(array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string);

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(array("\\", "¨", "º", " - ", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "<code>", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", ".", " "), '', $string);
    return $resultado = substr($string, 0, 10);
}