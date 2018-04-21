<?php
namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;

/**
 * Class Foto
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */


class Foto
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idFichero", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idFichero;


    /**
     *
     * @Assert\File(
     *     maxSize = "4024k",
     *     mimeTypes = {"image/*", "video/*"},
     *     mimeTypesMessage = "Formato no soportado",
     *     maxSizeMessage = "Archivo demasiado grande"
     * )
     */
    protected $Fichero;

    /**
      * @ORM\Column(name="Descripcion", type="text", nullable=true)
      * @Gedmo\Translatable
     */
    protected $Descripcion;

    /**
     * @ORM\Column(name="Fecha", type="datetime")
     *
     */
    protected $Fecha;

    /**
     * @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Album", inversedBy="fotos")
     * @ORM\JoinColumn(name="idAlbum", referencedColumnName="idAlbum")
     * @Assert\NotBlank(message="Debe seleccionar un album")
     */
    protected $Album;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;


    protected $temp;

    /**
     * @ORM\Column(name="Tipo", type="integer", length=1)
     */
    protected $Tipo;

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
    public function getIdFichero()
    {
        return $this->idFichero;
    }

    /**
     * @param int $idFichero
     */
    public function setIdFichero($idFichero)
    {
        $this->idFichero = $idFichero;
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
     * @param UploadedFile $file
     *
     */
    public function setFichero(UploadedFile $Fichero)
    {

            $this->Fichero = $Fichero;
            if (isset($this->path)) {
                // store the old name to delete after the update
                $this->temp = $this->path;
                $this->path = null;
            } else {
                $this->path = 'initial';
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

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $Fecha
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return mixed
     */
    public function getAlbum()
    {
        return $this->Album;
    }

    /**
     * @param mixed $Album
     */
    public function setAlbum(\feriaagropecuaria\BackendBundle\Entity\Album  $Album)
    {
        $this->Album = $Album;
    }



    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
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
            $ext = $this->getFichero()->guessExtension();
            $filename = sha1(uniqid(mt_rand(), true));
            $nombre = $filename.'.'.$ext;
            $this->path = $nombre;

            if(strtoupper($ext) == strtoupper("jpeg") || strtoupper($ext) == strtoupper("jpg") || strtoupper($ext) == strtoupper("png") || strtoupper($ext) == strtoupper("bmp"))
            {
                $this->setTipo(1);
            }else
            {
                $this->setTipo(2);
            }

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

        $this->getFichero()->move($this->getUploadRootDir(), $this->path);


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
     * @return mixed
     * 1 representa foto y 2 representa video
     */
    public function getTipo()
    {

        return $this->Tipo;
    }

    /**
     * @param mixed $extencion
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
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

    public function __toString()
    {
        return $this->getFichero();
    }
    public function __construct()
    {

        $this->Fecha = new \DateTime();
    }
}