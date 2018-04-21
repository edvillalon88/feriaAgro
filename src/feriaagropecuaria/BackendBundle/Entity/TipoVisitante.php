<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 26/02/2016
 * Time: 21:02
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use feriaagropecuaria\SolicitudBundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;

/**
 * Class TipoVisitante
 * @ORM\Entity()
 */

class TipoVisitante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTipoVisitante", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idTipoVisitante;


    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;


    /**
     * @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion", mappedBy="TipoVisitante", cascade={"ALL"})
     */
    private $Solicitudes;
    /**
     * @return mixed
     */

     /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getIdTipoVisitante()
    {
        return $this->idTipoVisitante;
    }

    /**
     * @param mixed $idTipoVisitante
     */
    public function setIdTipoVisitante($idTipoVisitante)
    {
        $this->idTipoVisitante = $idTipoVisitante;
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