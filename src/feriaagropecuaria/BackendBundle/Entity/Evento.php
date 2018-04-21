<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 19/02/2017
 * Time: 10:58
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Evento
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */

class Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idEvento;


    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="debe especificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;

    /**
     * @ORM\Column(name="Descripcion", type="text")
     * @Assert\NotBlank(message="debe especificar el valor de la descripcion")
     * @Gedmo\Translatable
     */
    protected $Descripcion;

    /**
     * @ORM\Column(name="Foto", type="string", nullable=true)
     *
     */
    protected $Foto;

    /**
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Formato no soportado"
     * )
     */
    protected $Fichero;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    protected $temp;

    /**
     * @return int
     */
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * @param int $idServicio
     */
    public function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;
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
            $this->temp = $this->Foto;
            $this->Foto = null;
        } else {
            $this->Foto = 'initial';
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->getFoto()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFoto();
    }

    public function getWebPathFoto()
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
        if (null != $this->getFichero()) {
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



    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    function __toString()
    {
        return $this->getNombre();
    }


}