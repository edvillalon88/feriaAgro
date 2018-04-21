<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 06/02/2016
 * Time: 19:53
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ServicioMobiliariaProducto
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity()
 */

class ServicioMobiliariaProducto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idServicioMobiliariaProducto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idServicioMobiliariaProducto;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el valor del nombre")
     */
    protected $Nombre;

    /**
     * @ORM\Column(name="Precio", type="decimal", scale=2)
     * @Assert\NotBlank(message="Debe espesificar el precio")
     */
    protected $Precio;

    /** @ORM\OneToMany(targetEntity="feriaagropecuaria\SolicitudBundle\Entity\SolicitudProducto", mappedBy="ServicioMobiliariaProducto" , cascade={"ALL"}) */
    protected $solicitudproductos;

    /**
     * @ORM\Column(name="Path", type="string")
     *
     */
    protected $Path;
    /**
     * @Assert\NotBlank(message="La foto no puede estar vacia")
     * @Assert\File(
     *     maxSize = "224k",
     *     mimeTypes = {"image/*"},
     *     mimeTypesMessage = "Formato no soportado"
     * )
     **/
    protected $Fichero;

    protected $temp;
    /**
     * @return int
     */
    public function getIdServicioMobiliariaProducto()
    {
        return $this->idServicioMobiliariaProducto;
    }

    /**
     * @param int $idServicioMobiliariaProducto
     */
    public function setIdServicioMobiliariaProducto($idServicioMobiliariaProducto)
    {
        $this->idServicioMobiliariaProducto = $idServicioMobiliariaProducto;
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
        if (isset($this->Path)) {
            // store the old name to delete after the update
            $this->temp = $this->Path;
            $this->Path = null;
        } else {
            $this->Path = 'initial';
        }


    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->Path;
    }

    /**
     * @param mixed $Path
     */
    public function setPath($Path)
    {
        $this->Path = $Path;
    }


    public function getAbsolutePath()
    {
        return null === $this->Path
            ? null
            : $this->getUploadRootDir().'/'.$this->Path;
    }

    public function getWebPath()
    {
        return null === $this->Path
            ? null
            : $this->getUploadDir().'/'.$this->Path;
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
            $this->setPath($filename.'.'.$this->getFichero()->guessExtension());
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

        $this->getFichero()->move($this->getUploadRootDir(), $this->Path);


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