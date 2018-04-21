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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use feriaagropecuaria\BackendBundle\Entity;

/**
 * Class SolicitudProducto
 * @ORM\Entity()
 * @UniqueEntity(fields = {"idSolicitudParticipacion","idServicioMobiliaria"}, message="Este producto ya existe para esta solicitud")
 */

class SolicitudProducto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSolicitudProducto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idSolicitudProducto;

    /**
     *
     * @ORM\ManyToOne(targetEntity="SolicitudParticipacion", inversedBy="solicitudproductos")
     * @ORM\JoinColumn(name="idSolicitudParticipacion", referencedColumnName="idSolicitudParticipacion")
     * @Assert\NotBlank(message="Debe seleccionar una solicitud")
     *
     */
    protected $Solicitud;

    /**
     *
     * @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\ServicioMobiliariaProducto" , inversedBy="solicitudproductos")
     * @ORM\JoinColumn(name="idServicioMobiliaria", referencedColumnName="idServicioMobiliariaProducto")
     * @Assert\NotBlank(message="Debe seleccionar un producto")
     *
     */
    protected $ServicioMobiliariaProducto;

    /**
     *  @ORM\Column(name="Cantidad", type="integer")
     *  @Assert\NotBlank(message="Debe poner una cantidad")
     */
    protected $Cantidad;

    /**
     * @return int
     */
    public function getIdSolicitudProducto()
    {
        return $this->idSolicitudProducto;
    }

    /**
     * @param int $idSolicitudProducto
     */
    public function setIdSolicitudProducto($idSolicitudProducto)
    {
        $this->idSolicitudProducto = $idSolicitudProducto;
    }

    /**
     * @return mixed
     */
    public function getSolicitud()
    {
        return $this->Solicitud;
    }

    /**
     * @param mixed $Solicitud
     */
    public function setSolicitud($Solicitud)
    {
        $this->Solicitud = $Solicitud;
    }

    /**
     * @return mixed
     */
    public function getServicioMobiliariaProducto()
    {
        return $this->ServicioMobiliariaProducto;
    }

    /**
     * @param mixed $Producto
     */
    public function setServicioMobiliariaProducto($ServicioMobiliariaProducto)
    {
        $this->ServicioMobiliariaProducto = $ServicioMobiliariaProducto;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->Cantidad;
    }

    /**
     * @param mixed $Cantidad
     */
    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;
    }

    public function __toString()
    {
        return $this->getProducto()->getNombre();
    }
}