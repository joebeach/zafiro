<?

class iLan {
    var $ip;
    var $network;
    var $broadcast;
    var $netmask;

    function __construct() {
        global $servidor;
        $fd = fopen($servidor->interfacesfile, "r");
        while (!feof($fd)) {
            $txt = trim(fgets($fd, 1024));
            $caca = explode(" ", $txt);
            if ($caca[0] == "iface") {
                $interface = $caca[1];
            }
            if ($interface ==  $servidor->ilan) {
                if ($caca[0] == "address") {
                    $this->ip = $caca[1];
                }
                if ($caca[0] == "network") {
                    $this->network = $caca[1];
                }
                if ($caca[0] == "broadcast") {
                    $this->broadcast = $caca[1];
                }
                if ($caca[0] == "netmask") {
                    $this->netmask = $caca[1];
                }
                if ($caca[0] == "gateway") {
                    $this->gateway = $caca[1];
                }
            }
        }
    }
}
?>