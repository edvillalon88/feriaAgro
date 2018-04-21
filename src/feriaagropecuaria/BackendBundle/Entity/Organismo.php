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
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;


/**
 * Class Organismo
 * @ORM\Entity()
 */

class Organismo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idOrganismo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idOrganismo;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    /**
     * @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion", mappedBy="Organismo", cascade={"ALL"})
     */
    private $Solicitudes;
    /**
     * @return mixed
     */
    public function getIdOrganismo()
    {
        return $this->idOrganismo;
    }

    /**
     * @param mixed $idOrganismo
     */
    public function setIdOrganismo($idOrganismo)
    {
        $this->idOrganismo = $idOrganismo;
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

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

}