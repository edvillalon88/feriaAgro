<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 26/02/2016
 * Time: 22:35
 */

namespace feriaagropecuaria\SolicitudBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use feriaagropecuaria\BackendBundle\Entity;

/**
 * Class Credencial
 * @ORM\Entity()
 */

class Credencial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCredencial", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCredencial;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     */
    protected $Nombre;

    /**
     * @ORM\Column(name="Ci", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del # de carnet")
     */
    protected $Ci;

    /**
     * @ORM\ManyToOne(targetEntity="SolicitudParticipacion", inversedBy="Credenciales")
     * @ORM\JoinColumn(name="idSolicitudParticipacion", referencedColumnName="idSolicitudParticipacion", nullable=false)
     * @Assert\NotBlank(message="Debe seleccionar una solicitud")
     */
    protected $SolicitudParticipacion;

    /**
     * @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Pais", inversedBy="Credenciales")
     * @ORM\JoinColumn(name="idPais", referencedColumnName="idPais", nullable=false)
     * @Assert\NotBlank(message="Debe seleccionar un Pais")
     */
    protected $Pais;

    /**
     * @ORM\Column(name="Cargo", type="string")
     * @Assert\NotBlank(message="Debe espesificar el cargo")
     */
    protected $Cargo;

    /**
     * @return int
     */
    public function getIdCredencial()
    {
        return $this->idCredencial;
    }

    /**
     * @param int $idCredencial
     */
    public function setIdCredencial($idCredencial)
    {
        $this->idCredencial = $idCredencial;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getCi()
    {
        return $this->Ci;
    }

    /**
     * @param mixed $Ci
     */
    public function setCi($Ci)
    {
        $this->Ci = $Ci;
    }

    /**
     * @return mixed
     */
    public function getSolicitudParticipacion()
    {
        return $this->SolicitudParticipacion;
    }

    /**
     * @param mixed $SolicitudParticipacion
     */
    public function setSolicitudParticipacion(SolicitudParticipacion $SolicitudParticipacion)
    {
        $this->SolicitudParticipacion = $SolicitudParticipacion;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->Pais;
    }

    /**
     * @param mixed $Pais
     */
    public function setPais(\feriaagropecuaria\BackendBundle\Entity\Pais $Pais)
    {
        $this->Pais = $Pais;
    }

    /**
     * @return mixed
     */
    public function getCargo()
    {
        return $this->Cargo;
    }

    /**
     * @param mixed $Cargo
     */
    public function setCargo($Cargo)
    {
        $this->Cargo = $Cargo;
    }



    public function __toString()
    {
        return $this->getNombre();
    }
}