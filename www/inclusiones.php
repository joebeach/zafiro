<?
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}

include_once "funciones.php";
include "modelo/servidor.php";
include "modelo/sql.php";

$servidor = new Servidor();
$iwan=new iwan();
$ilan=new ilan();

//ob_start();
//ini_set("error_reporting", 2047);

//A borrar???
$arrEstado[0] = "Activo";
$arrEstado[1] = "Inactivo";
$arrEstado[2] = "Borrar";
?>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
