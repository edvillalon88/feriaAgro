<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 06/02/2016
 * Time: 19:19
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Pais
 * @ORM\Entity()
 */

class Pais
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPais", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPais;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     */
    protected $Nombre;

    /**
     * @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion", mappedBy="Pais", cascade={"ALL"})
     */
    private $Solicitudes;

    /**
     * @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\Credencial", mappedBy="Pais", cascade={"ALL"})
     */
    private $Credenciales;
    /**
     * @return mixed
     */
    public function getIdPais()
    {
        return $this->idPais;
    }

    /**
     * @param mixed $idPais
     */
    public function setIdPais($idPais)
    {
        $this->idPais = $idPais;
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

    public function __toString()
    {
        return $this->getNombre();
    }

}