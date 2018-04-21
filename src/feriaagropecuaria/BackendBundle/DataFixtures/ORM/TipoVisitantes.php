<?php
/**
 * Created by PhpStorm.
 * User: eduardo.valdes
 * Date: 15/03/2016
 * Time: 13:55
 */

namespace feriaagropecuaria\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use feriaagropecuaria\BackendBundle\Entity\TipoVisitante;

class TipoVisitantes implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $repo = $manager->getRepository('feriaagropecuariaBackendBundle:TipoVisitante');
        $TipoVisitantes = array("Expositor", "Visitante Profesional");


        foreach ($TipoVisitantes as $tipo)
        {
            $ext=$repo->findBy(array('Nombre' => $tipo));
            if($ext==null)
            {
                $entidad = new TipoVisitante();
                $entidad->setNombre($tipo);

                $manager->persist($entidad);
            }

        }
        $manager->flush();

    }

}