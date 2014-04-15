<? 
include "inclusiones.php";
include "barra.php";
?>
<body>
    <h1>SETUP</h1>

    <?
    $configuracioncliente = f_Request("configuracioncliente");
    $configuracionipprivada = f_Request("ipprivada");
    $configuracionippublica = f_Request("ippublica");
    $configuraciongw = f_Request("configuraciongw");
    $configuraciondnspri = f_Request("configuraciondnspri");
    $configuraciondnssec = f_Request("configuraciondnssec");
    $configuraciondnster = f_Request("configuraciondnster");
    $wanmask = f_Request("wanmask");
    $lanmask = f_Request("lanmask");
    $lannetwork = f_Request("lannetwork");
    $lanbroadcast = f_Request("lanbroadcast");
    $wannetwork = f_Request("wannetwork");
    $wanbroadcast = f_Request("wanbroadcast");
    if (f_Request("configuracionacc")) {
        $configuracionacc = 1;
    } else {
        $configuracionacc = 0;
    }

    if (f_Request("ac") == "guardar") {
        $errores = "";
        $f = 0;

        $configuraciondnspri = f_Request("configuraciondnspri");
        $configuraciondnssec = f_Request("configuraciondnssec");
        $configuraciondnster = f_Request("configuraciondnster");

        /*
          if ($configuracionadspas!=f_Request("confirmapass")) {
          $errores .= "|La contrase�a no coincide con la confirmaci�n";
          }
         */

        //Mostrar Errores
        if ($errores != "") {
            f_imprime_errores($errores);
        } else {
            $interfaces = "";
            $interfaces.="auto lo\n";
            $interfaces.="iface lo inet loopback\n";
            $interfaces.="";
            $interfaces.="\n";
            $interfaces.="auto ".$servidor->iwan."\n";
            if ($configuracionippublica) {
                $interfaces.="iface ".$servidor->iwan." inet static\n";
                $interfaces.="    address " . $configuracionippublica . "\n";
                $interfaces.="    netmask " . $wanmask . "\n";
                $interfaces.="    network " . $wannetwork . "\n";
                $interfaces.="    broadcast " . $wanbroadcast . "\n";
                if ($configuraciongw) {
                    $interfaces.="    gateway " . $configuraciongw . "\n";
                }
            } else {
                $interfaces.="iface ".$servidor->iwan." inet dhcp\n";
            }
            $interfaces.="auto ".$servidor->ilan."\n";
            $interfaces.="iface ".$servidor->ilan." inet static\n";
            $interfaces.="    address " . $configuracionipprivada . "\n";
            $interfaces.="    network " . $lannetwork . "\n";
            $interfaces.="    broadcast " . $lanbroadcast . "\n";
            $interfaces.="    netmask " . $lanmask . "\n";

	    $interfaces.=$servidor->interfaces_additional();
            $file_to_write = $servidor->interfacesfile;
            $fd = fopen($file_to_write, "w+");
            fwrite($fd, $interfaces);
            fclose($fd);
            //break;

            $resolv = "";
            if (isset($configuraciondnspri)) {
                $resolv.="nameserver " . $configuraciondnspri . "\n";
            }
            if (isset($configuraciondnssec)) {
                $resolv.="nameserver " . $configuraciondnssec . "\n";
            }
            if (isset($configuraciondnster)) {
                $resolv.="nameserver " . $configuraciondnster . "\n";
            }
            $file_to_write = $servidor->resolvfile;
            $fd = fopen($file_to_write, "w+");
            fwrite($fd, $resolv);
            fclose($fd);

            //echo $configuracioncliente;
            if (isset($configuracioncliente)) {
                $hostname = $configuracioncliente;
            } else {
                $hostname = "Zafiro";
            }
            $fd = fopen($servidor->hostnamefile, "w+");
            fwrite($fd, $hostname);
            fclose($fd);

            if ($_POST["usuario"] && $_POST["password"]) {
                sql::execute("update usuarios set usuariosnom='" . $_POST["usuario"] . "',usuariospas='" . $_POST["password"] . "'");
            }

            header("Location: abmconfiguracion.php");
        }
    } else {
        if (isset($iwan->gateway)) {
            $configuraciongw = $iwan->gateway;
        }
        if (isset($iwan->network)) {
            $wannetwork = $iwan->network;
        }
        if (isset($ilan->network)) {
            $lannetwork = $ilan->network;
        }
        if (isset($iwan->broadcast)) {
            $wanbroadcast = $iwan->broadcast;
        }
        if (isset($ilan->broadcast)) {
            $lanbroadcast = $ilan->broadcast;
        }
        if (isset($iwan->netmask)) {
            $wanmask = $iwan->netmask;
        }
        if (isset($ilan->netmask)) {
            $lanmask = $ilan->netmask;
        }
        if (isset($nameserver[0])) {
            $configuraciondnspri = $nameserver[0];
        }
        if (isset($nameserver[1])) {
            $configuraciondnssec = $nameserver[1];
        }
        if (isset($nameserver[2])) {
            $configuraciondnster = $nameserver[2];
        }
    }



    $rs = sql::query("select usuariosnom,usuariospas from usuarios");
    $usu = mysql_fetch_array($rs);
    ?>
    <script language="JavaScript">
        function guardar() {
            if(datos.passwordconf.value!=datos.password.value){
                alert("Las confirmacion de password es incorrecta");
                exit();
            }
            document.datos.submit();
        }
    </script>

    <div style="float:left; width:605;">
        <form name="datos" action="?ac=guardar" method="post">
            <h2>Nombre del Servidor <? f_HTML_TextBox("configuracioncliente", $servidor->hostname, $extras["TextBoxABM"], 45); ?></h2>
            <div class="cuadro1">
                <table>
                    <caption>Configuracion WAN</caption>
                    <tr><th>IP</th>
                        <td>
                            <?
                            if (isset($iwan->ip)) {
                                f_HTML_TextBox("ippublica", $iwan->ip, $extras["TextBoxABM"], 15);
                            } else {
                                f_HTML_TextBox("ippublica", "", $extras["TextBoxABM"], 15);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><th>Mascara de subred</th><td><? f_HTML_TextBox("wanmask", $wanmask, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Network</th><td><? f_HTML_TextBox("wannetwork", $wannetwork, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Broadcast</th><td><? f_HTML_TextBox("wanbroadcast", $wanbroadcast, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Gateway</th><td><? f_HTML_TextBox("configuraciongw", $configuraciongw, $extras["TextBoxABM"], 15); ?></td></tr>
                </table>
            </div>
            <div class="cuadro1">
                <table>
                    <caption>Configuracion LAN</caption>
                    <!--<tr><td>Device LAN</td><td><? f_HTML_SelectValores("configuraciondevpri", $configuraciondevpri, $extras["SelectABM"], array('', 'eth0' => 'eth0', 'eth1' => 'eth1')); ?></td></tr>-->
                    <tr><th>IP</th><td><? f_HTML_TextBox("ipprivada", $ilan->ip, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Mascara de subred</th><td><? f_HTML_TextBox("lanmask", $lanmask, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Network</th><td><? f_HTML_TextBox("lannetwork", $lannetwork, $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>Broadcast</th><td><? f_HTML_TextBox("lanbroadcast", $lanbroadcast, $extras["TextBoxABM"], 15); ?></td></tr>

                </table>
            </div>
            <div class="cuadro1">
                <table>
                    <caption>Resoluci&oacute;n de nombres</caption>
                    <tr><th>DNS 1</th><td><? f_HTML_TextBox("configuraciondnspri", $servidor->dns[1], $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>DNS 2</th><td><? f_HTML_TextBox("configuraciondnssec", $servidor->dns[2], $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><th>DNS 3</th><td><? f_HTML_TextBox("configuraciondnster", $servidor->dns[3], $extras["TextBoxABM"], 15); ?></td></tr>
                    <tr><td colspan="2">Para recibir automaticamente las DNSs desde <br/>el proveedor, ingresar 0.0.0.0 en las tres DNSs</td></tr>
                </table>
            </div>
            <div class="cuadro1">
                <table>
                    <caption>Usuario y contrase&ntilde;a de ingreso</caption>
                    <tr>
                        <th>Usuario</th><td><input name="usuario" value="<? echo $usu["usuariosnom"]; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Password</th><td><input name="password" type="password" value="<? echo $usu["usuariospas"]; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Confirmaci&oacute;n</th><td><input name="passwordconf" type="password" value="<? echo $usu["usuariospas"]; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Permitir solo acceso GUI por placa interna</th><td>
                            <?
                            if ($configuracionacc) {
                                $configuracionacc = " checked";
                            }
                            f_HTML_CheckBox("configuracionacc", 1, $configuracionacc);
                            ?>
                        </td>
                    </tr>

                </table>
            </div>
            <div style="width: 600px; text-align: center;"><? f_HTML_Button("boGuardar", "Guardar", $extras["ButtonABM"] . " onclick=\"guardar();\""); ?></div>
        </form>
    </div>
    
</body>
