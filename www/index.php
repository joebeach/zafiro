<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?
session_start();
$_SESSION["usuario"]=NULL;
if (isset($_POST["txtusu"]) && $_POST["txtpas"]) {
    include "modelo/sql.php";
    $sql = "select usuariosid from usuarios where usuariosnom='" . $_POST["txtusu"] . "' and usuariospas='" . $_POST["txtpas"] . "'";
    $rsusuarios = sql::query($sql);
    $rsusuarios = mysql_fetch_assoc($rsusuarios);
    var_dump($rsusuarios);

    if ($rsusuarios["usuariosid"]) {
        session_start();
        $_SESSION["usuario"]=1;
        //header("Location: menu.php");
        header("Location: resumen.php");
    }
}
include "modelo/servidor.php";

?>
<html>
    <body>
    <head>
        <title>ZAFIRO - <? echo $servidor->hostname; ?></title>
    </head>
    <form method="post" action="index.php">
        <body>
            <div style="margin: 50px auto; text-align: center;">
                <img src="Imagenes/ZAFIRO-LOGO.png"></img>
                <h1><? echo $servidor->hostname; ?></h1>
                <br/>
                Usuario<br/>
                <input name="txtusu"/><br/>
                Contrase&ntilde;a<br/>
                <input name="txtpas" type="password"/><br/><br/>
                <button type=submit>Ingresar</button>
            </div>
        </body>
    </form>
</html>
