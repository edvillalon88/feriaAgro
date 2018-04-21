<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 06/02/2016
 * Time: 19:39
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;


/**
 * Class Area
 * @ORM\Entity()
 */

class Area
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idArea", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idArea;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;

    /**
     * @ORM\Column(name="Precio", type="decimal", scale=2)
     * @Assert\NotBlank(message="Debe espesificar el precio")
     */
    protected $Precio;

    /**
     * @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion", mappedBy="Area", cascade={"ALL"})
     */
    private $Solicitudes;
    /**
     * @return int
     */

    /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }


    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * @param int $idArea
     */
    public function setIdArea($idArea)
    {
        $this->idArea = $idArea;
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
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * @param mixed $Precio
     */
    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}