<?php
namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;

/**
 * Class Album
 * @ORM\Entity()
 */

class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAlbum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idAlbum;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;

    /**
     * @ORM\OneToMany(targetEntity="Foto", mappedBy="Album", cascade={"ALL"})
     */
    private $fotos;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
    public function getIdAlbum()
    {
        return $this->idAlbum;
    }

    /**
     * @param mixed $idAlbum
     */
    public function setIdAlbum($idAlbum)
    {
        $this->idAlbum = $idAlbum;
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

    /**
     * @return mixed
     */
    public function getFotos()
    {
        return $this->fotos;
    }

    /**
     * @return mixed
     */





    public function __construct()
    {
        $this->fotos = new ArrayCollection();



    }
}