<?php
/**
 * Created by PhpStorm.
 * User: eduardo.valdes
 * Date: 16/03/2016
 * Time: 14:59
 */

namespace feriaagropecuaria\SolicitudBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use feriaagropecuaria\BackendBundle\Entity;

/**
 * Class Rechazo
 * @ORM\Entity()
 */
class Rechazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRechazo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idRechazo;

    /**
     * @ORM\Column(name="Descripcion", type="text")
     * @Assert\NotBlank(message="Debe poner alguna descripcion")
     */
    protected $Descripcion;

    /**
     * @ORM\OneToOne(targetEntity="SolicitudParticipacion", inversedBy="rechazo")
     * @ORM\JoinColumn(name="idSolicitudParticipacion", referencedColumnName="idSolicitudParticipacion", nullable=false)
     * @Assert\NotBlank(message="Debe seleccionar una solicitud")
     */
    protected $solicitudParticipacion;

    /**
     * @return mixed
     */
    public function getIdRechazo()
    {
        return $this->idRechazo;
    }

    /**
     * @param mixed $idRechazo
     */
    public function setIdRechazo($idRechazo)
    {
        $this->idRechazo = $idRechazo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getsolicitudParticipacion()
    {
        return $this->SolicitudParticipacion;
    }

    /**
     * @param mixed $Solicitud
     */
    public function setsolicitudParticipacion (SolicitudParticipacion $Solicitud)
    {
        $this->solicitudParticipacion = $Solicitud;
    }

    public function __toString()
    {
        return  (string)$this->getIdRechazo();
    }

}