<?php
/**
 * Created by PhpStorm.
 * User: Enrique
 * Date: 09/04/2016
 * Time: 1:07
 */

namespace feriaagropecuaria\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use feriaagropecuaria\BackendBundle\Entity\Area;

class Areas implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $repo = $manager->getRepository('feriaagropecuariaBackendBundle:Area');
        $areeas = array(array('Nombre'=>'Stand Montado/Shell scheme stand', 'Precio'=>94.00),array('Nombre'=>'Área sin Montar/Indoor area', 'Precio'=>74.00),array('Nombre'=>'Área exterior', 'Precio'=>50.00));

        foreach ($areeas as $area)
        {
            $ext=$repo->findBy(array('Nombre' => $area['Nombre']));
            if($ext==null)
            {
                $entidad = new Area();
                $entidad->setNombre($area['Nombre']);
                $entidad->setPrecio($area['Precio']);

                $manager->persist($entidad);
            }

        }
        $manager->flush();
    }

}