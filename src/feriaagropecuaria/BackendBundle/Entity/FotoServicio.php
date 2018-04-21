<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 06/02/2016
 * Time: 17:26
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;


/**
 * Class FotoServicio
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity()
 */

class FotoServicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idFotoServicio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idFotoServicio;

    /**
     * @ORM\Column(name="Fichero", type="string")
     *
     */
    protected $Foto;

    /**
     * @Assert\NotBlank(message="La foto no puede estar vacia")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"image/*"},
     *     mimeTypesMessage = "Formato no soportado"
     * )
    **/
    protected $Fichero;


    /**
     * @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Servicio")
     * @ORM\JoinColumn(name="idServicio", referencedColumnName="idServicio")
     * @Assert\NotBlank(message="Debe seleccionar un servicio")
     */
    protected $Servicio;

    protected $temp;

    /**
     * @ORM\Column(name="Descripcion", type="text")
     * @Assert\NotBlank(message="debe especificar el valor de la descripcion")
     * @Gedmo\Translatable
     */
    protected $Descripcion;



    /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
    /**
     * @return int
     */
    public function getIdFotoServicio()
    {
        return $this->idFotoServicio;
    }

    /**
     * @param int $idFotoServicio
     */
    public function setIdFotoServicio($idFotoServicio)
    {
        $this->idFotoServicio = $idFotoServicio;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->Foto;
    }

    /**
     * @param mixed $Foto
     */
    public function setFoto($Foto)
    {
        $this->Foto = $Foto;
    }

    /**
     * @return mixed
     */
    public function getServicio()
    {
        return $this->Servicio;
    }

    /**
     * @param mixed $Servicio
     */
    public function setServicio(\feriaagropecuaria\BackendBundle\Entity\Servicio $Servicio)
    {
        $this->Servicio = $Servicio;
    }
    /**
     * @return mixed
     */
    public function getFichero()
    {
        return $this->Fichero;
    }

    /**
     * @param mixed $Fichero
     */
    public function setFichero(UploadedFile $Fichero)
    {
        $this->Fichero = $Fichero;
        if (isset($this->Foto)) {
            // store the old name to delete after the update
            $this->temp = $this->getFoto();
            $this->setFoto(null);
        } else {
            $this->setFoto('initial');
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->getFoto()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFoto();
    }

    public function getWebPath()
    {
        return null === $this->getFoto()
            ? null
            : $this->getUploadDir().'/'.$this->getFoto();
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'uploads/documents';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFichero()) {
            // haz lo que quieras para generar un nombre �nico
            $filename = sha1(uniqid(mt_rand(), true));
            $this->setFoto($filename.'.'.$this->getFichero()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFichero()) {
            return;
        }

        // si hay un error al mover el archivo, move() autom�ticamente
        // env�a una excepci�n. This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFichero()->move($this->getUploadRootDir(), $this->getFoto());

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->Fichero = null;
    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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



    public function __toString()
    {
        return $this->getFoto();
    }

}