<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 19/03/2016
 * Time: 8:45
 */

namespace feriaagropecuaria\HomeBundle\Entity;


class Contacto
{
    protected $Nombre;
    protected $Telefono;
    protected $Email;
    protected $Pais;
    protected $Texto;

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
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $Telefoono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
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
    public function setPais($Pais)
    {
        $this->Pais = $Pais;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->Texto;
    }

    /**
     * @param mixed $Texto
     */
    public function setTexto($Texto)
    {
        $this->Texto = $Texto;
    }



}