<?php
namespace feriaagropecuaria\SolicitudBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use feriaagropecuaria\BackendBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class SolicitudParticipacion
 * @ORM\Entity()
 */
class SolicitudParticipacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSolicitudParticipacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idSolicitudParticipacion;

    /**
     * @ORM\Column(name="Nombre", type="string")
     * @Assert\NotBlank(message="Debe espesificar el nombre")
     */
    protected $Nombre;

    /** @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\TipoVisitante")
     * @ORM\JoinColumn(name="idTipoVisitante", referencedColumnName="idTipoVisitante")
     * @Assert\NotBlank(message="Debe seleccionar un Tipo de Visitante")
     */
    protected $TipoVisitante;

    /**
     * @ORM\Column(name="NombreFirma", type="string")
     * @Assert\NotBlank(message="Debe espesificar el nombre de la firma")
     */
    protected $NombreFirma;

    /**
     * @ORM\Column(name="Direccion", type="string")
     * @Assert\NotBlank(message="Debe espesificar la direccion")
     */
    protected $Direccion;

    /**
     * @ORM\Column(name="CodigoPostal", type="integer")
     * @Assert\NotBlank(message="Debe espesificar el codigo postal")
     */
    protected $CodigoPostal;

    /** @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Pais")
     * @ORM\JoinColumn(name="idPais", referencedColumnName="idPais")
     * @Assert\NotBlank(message="Debe seleccionar un Pais")
     */
    protected $Pais;

    /** @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Organismo")
     * @ORM\JoinColumn(name="idOrganismo", referencedColumnName="idOrganismo", nullable = true)
     *
     */
    protected $Organismo;




    /**
     * @ORM\Column(name="telefono", type="integer")
     * @Assert\NotBlank(message="Debe espesificar el telefono")
     */
    protected $Telefono;

    /**
     * @ORM\Column(name="fax", type="integer")
     * @Assert\NotBlank(message="Debe espesificar el fax")
     */
    protected $Fax;

    /**
     * @ORM\Column(name="email", type="string")
     * @Assert\NotBlank(message="Debe espesificar el correo")
     * @Assert\Email(message="debe ser un formato de correo valido")
     */
    protected $email;

    /** @ORM\ManyToOne(targetEntity="feriaagropecuaria\BackendBundle\Entity\Area")
     * @ORM\JoinColumn(name="idArea", referencedColumnName="idArea")
     * @Assert\NotBlank(message="Debe seleccionar un Area")
     */
    protected $Area;

    /**
     * @ORM\Column(name="Metros", type="integer")
     * @Assert\NotBlank(message="Debe espesificar los metros")
     */
    protected $Metros;

    /**
     * @ORM\Column(name="Rotulo", type="string")
     *
     */
    protected $Rotulo;

    /**
     * @ORM\Column(name="Productos", type="text")
     * @Assert\NotBlank(message="Debe espesificar los Productos")
     */
    protected $Productos;

    /**
     * @ORM\Column(name="Firmas", type="text")
     * @Assert\NotBlank(message="Debe espesificar los firmas")
     */
    protected $Firmas;

    /**
     * @ORM\Column(name="Observaciones", type="text")

     */
    protected $Observaciones;

    /**
     * @ORM\Column(name="identificador", type="integer")

     */
    protected $identificador;

    /**
     * @ORM\Column(name="FechaCreado", type="date")

     */
    protected $FechaCreado;

    /**
     * @ORM\Column(name="Aprobado", type="boolean")

     */
    protected $Aprobada;


    /**
     *
     * @Assert\File(
     *     maxSize = "024k",
     *     mimeTypesMessage = "Formato no soportado",
     *     maxSizeMessage = "Archivo demasiado grande"
     * )
     */
    protected $fichero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $Path;

    /**
     * @ORM\Column(name="CodigoContrato", type="integer", length=11)
     */
    protected $CodigoContrato;

    /**
     * @ORM\Column(name="Sala", type="string")
     */
    protected $Sala;

    /**
     * @ORM\Column(name="Stan", type="integer", length=4)
     */
    protected $Stan;

    /** @ORM\OneToMany(targetEntity="SolicitudProducto", mappedBy="Solicitud" , cascade={"ALL"})
     *  @Assert\NotBlank(message="Debe agregar almenos 1 producto")
     */
    protected $solicitudproductos;

    /**
     * @ORM\OneToMany(targetEntity="Credencial", mappedBy="SolicitudParticipacion" , cascade={"ALL"})
     *
     */
    protected $Credenciales;


    /**
     * @ORM\OneToOne(targetEntity="Rechazo", mappedBy="solicitudParticipacion", cascade={"ALL"})
     *
     */
    protected $rechazo;


    /**
     * @return ArrayCollection
     */
    public function getSolicitudproductos()
    {

        return $this->solicitudproductos;

    }

    /**
     * @param ArrayCollection $solicitudproducto
     */


    public function addSolicitudproducto(SolicitudProducto $solicitudproducto)
    {
            $solicitudproducto->setSolicitud($this);

            $this->solicitudproductos->add($solicitudproducto);


    }

    public function removeSolicitudproducto(SolicitudProducto $solicitudproducto)
    {
        $this->solicitudproductos->removeElement($solicitudproducto);
    }

    /**
     * @return mixed
     */
    public function getCredenciales()
    {
        return $this->Credenciales;
    }



    public function addCredencial(Credencial $credencial)
    {

        $credencial->setSolicitudParticipacion($this);
        $this->Credenciales->add($credencial);


    }

    public function removeCredencial(Credencial $credencial)
    {
        $this->Credenciales->removeElement($credencial);
    }
    public function ClearSP()
    {
        $this->solicitudproductos->clear();
    }

    /**
     * @return int
     */
    public function getIdSolicitudParticipacion()
    {
        return $this->idSolicitudParticipacion;
    }

    /**
     * @param int $idSolicitudParticipacion
     */
    public function setIdSolicitudParticipacion($idSolicitudParticipacion)
    {
        $this->idSolicitudParticipacion = $idSolicitudParticipacion;
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
    public function getTipoVisitante()
    {
        return $this->TipoVisitante;
    }

    /**
     * @param mixed $TipoVisitante
     */
    public function setTipoVisitante(\feriaagropecuaria\BackendBundle\Entity\TipoVisitante $TipoVisitante)
    {
        $this->TipoVisitante = $TipoVisitante;
    }

    /**
     * @return mixed
     */
    public function getNombreFirma()
    {
        return $this->NombreFirma;
    }

    /**
     * @param mixed $NombreFirma
     */
    public function setNombreFirma($NombreFirma)
    {
        $this->NombreFirma = $NombreFirma;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }

    /**
     * @return mixed
     */
    public function getCodigoPostal()
    {
        return $this->CodigoPostal;
    }

    /**
     * @param mixed $CodigoPostal
     */
    public function setCodigoPostal($CodigoPostal)
    {
        $this->CodigoPostal = $CodigoPostal;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->Pais;
    }

    /**
     * @param mixed $Pais
     */
    public function setPais(\feriaagropecuaria\BackendBundle\Entity\Pais $Pais)
    {
        $this->Pais = $Pais;
    }

    /**
     * @return mixed
     */
    public function getOrganismo()
    {
        return $this->Organismo;
    }

    /**
     * @param mixed $Organismo
     */
    public function setOrganismo(\feriaagropecuaria\BackendBundle\Entity\Organismo $Organismo)
    {
        $this->Organismo = $Organismo;
    }


    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->Fax;
    }

    /**
     * @param mixed $Fax
     */
    public function setFax($Fax)
    {
        $this->Fax = $Fax;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->Area;
    }

    /**
     * @param mixed $Area
     */
    public function setArea(\feriaagropecuaria\BackendBundle\Entity\Area $Area)
    {
        $this->Area = $Area;
    }

    /**
     * @return mixed
     */
    public function getMetros()
    {
        return $this->Metros;
    }

    /**
     * @param mixed $Metros
     */
    public function setMetros($Metros)
    {
        $this->Metros = $Metros;
    }

    /**
     * @return mixed
     */
    public function getProductos()
    {
        return $this->Productos;
    }

    /**
     * @param mixed $Productos
     */
    public function setProductos($Productos)
    {
        $this->Productos = $Productos;
    }

    /**
     * @return mixed
     */
    public function getFirmas()
    {
        return $this->Firmas;
    }

    /**
     * @param mixed $Firmas
     */
    public function setFirmas($Firmas)
    {
        $this->Firmas = $Firmas;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->Observaciones;
    }

    /**
     * @param mixed $Observaciones
     */
    public function setObservaciones($Observaciones)
    {
        $this->Observaciones = $Observaciones;
    }

    /**
     * @return mixed
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * @param mixed $identificador
     */
    public function setIdentificador()
    {
        $this->identificador = time();
    }

    /**
     * @return mixed
     */
    public function getFechaCreado()
    {
        return $this->FechaCreado;
    }

    /**
     * @param mixed $FechaCreado
     */
    public function setFechaCreado($FechaCreado)
    {
        $this->FechaCreado = $FechaCreado;
    }

    /**
     * @return mixed
     */
    public function getAprobada()
    {
        return $this->Aprobada;
    }

    /**
     * @param mixed $Aprobada
     */
    public function setAprobada($Aprobada = false)
    {
        $this->Aprobada = $Aprobada;
    }

    /**
     * @return mixed
     */
    public function getRotulo()
    {
        return $this->Rotulo;
    }

    /**
     * @param mixed $Rotulo
     */
    public function setRotulo($Rotulo)
    {
        $this->Rotulo = $Rotulo;
    }

    /**
     * @return mixed
     */
    public function getrechazo()
    {
        return $this->rechazo;
    }

    /**
     * @return mixed
     */





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

    public function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'uploads/img';
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

    /**
     * @return mixed
     */
    public function getCodigoContrato()
    {
        return $this->CodigoContrato;
    }

    /**
     * @param mixed $CodigoContrato
     */
    public function setCodigoContrato($CodigoContrato)
    {
        $this->CodigoContrato = $CodigoContrato;
    }

    /**
     * @return mixed
     */
    public function getSala()
    {
        return $this->Sala;
    }

    /**
     * @param mixed $Sala
     */
    public function setSala($Sala)
    {
        $this->Sala = $Sala;
    }

    /**
     * @return mixed
     */
    public function getStan()
    {
        return $this->Stan;
    }

    /**
     * @param mixed $Stan
     */
    public function setStan($Stan)
    {
        $this->Stan = $Stan;
    }





    public function __toString()
    {
        return  (string)$this->getIdentificador();
    }



    public function __construct()
    {
        $this->Credenciales = new ArrayCollection();
        $this->FechaCreado = new \DateTime();
        $this->setAprobada();
        $this->setIdentificador();
        $this->solicitudproductos = new ArrayCollection();


    }


}