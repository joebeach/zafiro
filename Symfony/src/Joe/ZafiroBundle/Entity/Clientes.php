<?php

namespace Joe\ZafiroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @ORM\Table(name="clientes", indexes={@ORM\Index(name="IDX_50FE07D7DD5A5B7D", columns={"plan"})})
 * @ORM\Entity
 */
class Clientes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="macaddress", type="string", length=45, nullable=false)
     */
    private $macaddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ip", type="integer", nullable=false)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecha_alta", type="integer", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecha_baja", type="integer", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="plan", type="integer", nullable=false)
     */
    private $plan;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=45, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=45, nullable=true)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="enruta_proxy", type="boolean", nullable=true)
     */
    private $enrutaProxy;

    /**
     * @var integer
     *
     * @ORM\Column(name="salida_habilitada", type="boolean", nullable=true)
     */
    private $salidaHabilitada;

    /**
     * @var integer
     * JOE Asi se hace un inner join
     * @ORM\ManyToOne(targetEntity="Planes" ,inversedBy="plan_clientes")
     * @ORM\JoinColumn(name="plan",referencedColumnName="id")
     */
    private $clientes_plan;
    
    /**
     * @var integer
     * JOE Asi se hace un inner join
     * @ORM\ManyToOne(targetEntity="Interfaces" ,inversedBy="interface_clientes")
     * @ORM\JoinColumn(name="interface",referencedColumnName="id")
     */
    private $clientes_interface;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Clientes
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set macaddress
     *
     * @param string $macaddress
     * @return Clientes
     */
    public function setMacaddress($macaddress)
    {
        $this->macaddress = $macaddress;

        return $this;
    }

    /**
     * Get macaddress
     *
     * @return string 
     */
    public function getMacaddress()
    {
        return $this->macaddress;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Clientes
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ip
     *
     * @param integer $ip
     * @return Clientes
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return integer 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set fechaAlta
     *
     * @param integer $fechaAlta
     * @return Clientes
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return integer 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaBaja
     *
     * @param integer $fechaBaja
     * @return Clientes
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return integer 
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set plan
     *
     * @param integer $plan
     * @return Clientes
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return integer 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Clientes
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Clientes
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Clientes
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     * @return Clientes
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Clientes
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set enrutaProxy
     *
     * @param integer $enrutaProxy
     * @return Clientes
     */
    public function setEnrutaProxy($enrutaProxy)
    {
        $this->enrutaProxy = $enrutaProxy;

        return $this;
    }

    /**
     * Get enrutaProxy
     *
     * @return integer 
     */
    public function getEnrutaProxy()
    {
        return $this->enrutaProxy;
    }

    /**
     * Set salidaHabilitada
     *
     * @param integer $salidaHabilitada
     * @return Clientes
     */
    public function setSalidaHabilitada($salidaHabilitada)
    {
        $this->salidaHabilitada = $salidaHabilitada;

        return $this;
    }

    /**
     * Get salidaHabilitada
     *
     * @return integer 
     */
    public function getSalidaHabilitada()
    {
        return $this->salidaHabilitada;
    }
    
    /**
     *  JOE
     * @param unknown $id
     */
    public function toggle_salida()
    {
    	$valor=0;
    	$valor=($this->getSalidaHabilitada()) ? 0 : 1;
    	$this->setSalidaHabilitada($valor);
    	 
    }
    
    public function toggle_proxy()
    {
    	$valor=0;
    	$valor=($this->getEnrutaProxy()) ? 0 : 1;
    	$this->setEnrutaProxy($valor);
    
    }

    public function toggle_estado()
    {
    	$valor=0;
    	$valor=($this->getEstado()) ? 0 : 1;
    	$this->setEstado($valor);
    
    }
    /**
     * Set clientes_plan
     *
     * @param \Joe\ZafiroBundle\Entity\Planes $clientesPlan
     * @return Clientes
     */
    public function setClientesPlan(\Joe\ZafiroBundle\Entity\Planes $clientesPlan = null)
    {
        $this->clientes_plan = $clientesPlan;

        return $this;
    }

    /**
     * Get clientes_plan
     *
     * @return \Joe\ZafiroBundle\Entity\Planes 
     */
    public function getClientesPlan()
    {
        return $this->clientes_plan;
    }
    
    public static function estados(){
    	return array(
    			'1' => 'Activo',
    			'0' => 'Inactivo',
    	);
    }
    public function getNombreEstado(){
    	$a = $this->estados();
    	return $a[$this->estado];
    }
    
    /**
     * Set interface
     *
     * @param integer $interface
     * @return Clientes
     */
    public function setInterface($interface)
    {
    	$this->interface = $interface;
    
    	return $this;
    }
    
    /**
     * Get interface
     *
     * @return integer
     */
    public function getInterface()
    {
    	return $this->interface;
    }
    
    /**
     * Set clientes_interface
     *
     * @param \Joe\ZafiroBundle\Entity\Planes $clientesInterface
     * @return Clientes
     */
    public function setClientesInterface(\Joe\ZafiroBundle\Entity\Interfaces $clientesInterface = null)
    {
    	$this->clientes_interface = $clientesInterface;
    
    	return $this;
    }
    
    /**
     * Get clientes_interface
     *
     * @return \Joe\ZafiroBundle\Entity\Interfaces
     */
    public function getClientesInterface()
    {
    	return $this->clientes_interface;
    }
}
