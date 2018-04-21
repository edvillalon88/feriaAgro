<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 06/02/2016
 * Time: 17:35
 */

namespace feriaagropecuaria\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\Translation;

/**
 * Class Producto
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */


class Producto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProducto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idProducto;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="debe especificar el valor del nombre")
     * @Gedmo\Translatable
     */
    protected $Nombre;

    /**
     * @ORM\Column(name="Foto1", type="string", nullable=true)
     *
     */
    protected $Foto1;

    /**
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Formato no soportado"
     * )
     */
    protected $Fichero1;

    /**
     * @ORM\Column(name="Foto2", type="string", nullable=true)
     *
     * )
     */
    protected $Foto2;
    /**
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Formato no soportado"
     * )
     */
    protected $Fichero2;
    /**
     * @ORM\Column(name="Foto3", type="string", nullable=true)
     *
     */
    protected $Foto3;
    /**
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Formato no soportado"
     * )
     */
    protected $Fichero3;
    /**
     * @ORM\Column(name="Descripcion", type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $Descripcion;

    /**
     * @ORM\Column(name="Precio", type="decimal", nullable=false, scale=2)
     *
     */
    protected $Precio;

    protected $temp1;
    protected $temp2;
    protected $temp3;


    /**
     * @Gedmo\Locale
     */
    private $locale;

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
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

    /**
     * @return int
     */

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * @param int $idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
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
    public function getFoto1()
    {
        return $this->Foto1;
    }

    /**
     * @param mixed $Foto1
     */
    public function setFoto1($Foto1)
    {
        $this->Foto1 = $Foto1;
    }

    /**
     * @param mixed $Fichero1
     * @param UploadedFile $file
     *
     */
    public function setFichero1(UploadedFile $Fichero1)
    {
        $this->Fichero1 = $Fichero1;
        if (isset($this->Foto1)) {
            // store the old name to delete after the update
            $this->temp1 = $this->Foto1;
            $this->Foto1 = null;
        } else {
            $this->Foto1 = 'initial';
        }
    }
    /**
     * @param mixed $Fichero2
     * @param UploadedFile $file
     *
     */
    public function setFichero2(UploadedFile $Fichero2)
    {
        $this->Fichero2 = $Fichero2;
        if (isset($this->Foto2)) {
            // store the old name to delete after the update
            $this->temp2 = $this->Foto2;
            $this->Foto2 = null;
        } else {
            $this->Foto2 = 'initial';
        }
    }

    /**
     * @param mixed $Fichero3
     * @param UploadedFile $file
     *
     */
    public function setFichero3(UploadedFile $Fichero3)
    {
        $this->Fichero3 = $Fichero3;
        if (isset($this->Foto3)) {
            // store the old name to delete after the update
            $this->temp3 = $this->Foto3;
            $this->Foto3 = null;
        } else {
            $this->Foto3 = 'initial';
        }
    }
    /**
     * @return mixed
     */
    public function getFichero1()
    {
        return $this->Fichero1;
    }

    /**
     * @return mixed
     */
    public function getFichero2()
    {
        return $this->Fichero2;
    }

    /**
     * @return mixed
     */
    public function getFichero3()
    {
        return $this->Fichero3;
    }


    public function getAbsolutePath1()
    {
        return null === $this->getFoto1()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFoto1();
    }

    public function getAbsolutePath2()
    {
        return null === $this->getFoto2()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFoto2();
    }

    public function getAbsolutePath3()
    {
        return null === $this->getFoto3()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFoto3();
    }

    public function getWebPathFoto1()
    {
        return null === $this->getFoto1()
            ? null
            : $this->getUploadDir().'/'.$this->getFoto1();
    }

    public function getWebPathFoto2()
    {
        return null === $this->getFoto2()
            ? null
            : $this->getUploadDir().'/'.$this->getFoto2();
    }

    public function getWebPathFoto3()
    {
        return null === $this->getFoto3()
            ? null
            : $this->getUploadDir().'/'.$this->getFoto3();
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
        if (null !== $this->getFichero1()) {
            // haz lo que quieras para generar un nombre �nico
            $filename = sha1(uniqid(mt_rand(), true));
            $this->setFoto1($filename.'.'.$this->getFichero1()->guessExtension());
        }

        if (null !== $this->getFichero2()) {
            // haz lo que quieras para generar un nombre �nico
            $filename = sha1(uniqid(mt_rand(), true));
            $this->setFoto2($filename.'.'.$this->getFichero2()->guessExtension());
        }

        if (null !== $this->getFichero3()) {
            // haz lo que quieras para generar un nombre �nico
            $filename = sha1(uniqid(mt_rand(), true));
            $this->setFoto3($filename.'.'.$this->getFichero3()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFichero1()&& null === $this->getFichero2() && null === $this->getFichero3()) {
            return;
        }
        if (null != $this->getFichero1()) {
            // si hay un error al mover el archivo, move() autom�ticamente
            // env�a una excepci�n. This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFichero1()->move($this->getUploadRootDir(), $this->getFoto1());

            // check if we have an old image
            if (isset($this->temp1)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp1);
                // clear the temp image path
                $this->temp1 = null;
            }
            $this->Fichero1 = null;
        }
        if (null != $this->getFichero2()) {
            // si hay un error al mover el archivo, move() autom�ticamente
            // env�a una excepci�n. This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFichero2()->move($this->getUploadRootDir(), $this->getFoto2());

            // check if we have an old image
            if (isset($this->temp2)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp2);
                // clear the temp image path
                $this->temp2 = null;
            }
            $this->Fichero2 = null;
        }
        if (null != $this->getFichero3()) {
            // si hay un error al mover el archivo, move() autom�ticamente
            // env�a una excepci�n. This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFichero3()->move($this->getUploadRootDir(), $this->getFoto3());

            // check if we have an old image
            if (isset($this->temp3)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp3);
                // clear the temp image path
                $this->temp3 = null;
            }
            $this->Fichero3 = null;
        }


    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file1 = $this->getAbsolutePath1()) {
            unlink($file1);
        }
        if ($file2 = $this->getAbsolutePath2()) {
            unlink($file2);
        }
        if ($file3 = $this->getAbsolutePath3()) {
            unlink($file3);
        }
    }





    /**
     * @return mixed
     */
    public function getFoto2()
    {
        return $this->Foto2;
    }

    /**
     * @param mixed $Foto2
     */
    public function setFoto2($Foto2)
    {
        $this->Foto2 = $Foto2;
    }

    /**
     * @return mixed
     */
    public function getFoto3()
    {
        return $this->Foto3;
    }

    /**
     * @param mixed $Foto3
     */
    public function setFoto3($Foto3)
    {
        $this->Foto3 = $Foto3;
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
        return $this->getNombre();
    }

}