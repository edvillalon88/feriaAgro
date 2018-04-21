<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 24/03/2016
 * Time: 17:27
 */

namespace feriaagropecuaria\HomeBundle\Entity;



class ViewModelPaginado
{
    protected $Cantidad;
    protected $Producto;

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->Cantidad;
    }

    /**
     * @param mixed $Cantidad
     */
    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->Producto;
    }

    /**
     * @param mixed $Producto
     */
    public function setProducto(\feriaagropecuaria\BackendBundle\Entity\Producto $Producto)
    {
        $this->Producto = $Producto;
    }



}