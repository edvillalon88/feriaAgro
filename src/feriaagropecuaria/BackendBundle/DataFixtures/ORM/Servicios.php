<?php
/**
 * Created by PhpStorm.
 * User: eduardo.valdes
 * Date: 22/03/2016
 * Time: 9:32
 */

namespace feriaagropecuaria\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use feriaagropecuaria\BackendBundle\Entity\Servicio;

class Servicios implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $repo = $manager->getRepository('feriaagropecuariaBackendBundle:Servicio');
        $Servicios = array(array('Nombre'=>'ALQUILER DE ESPACIOS', 'Descripcion'=>'Contamos con áreas interiores y exteriores donde usted puede desarrollar un encuentro social, cultural o de negocios, con precios asequibles y donde encontrara un ambiente agradable acompañado de un trato adecuado y muy profesional. Nuestros locales son todos climatizados y con buena iluminación y acústica, mobiliario y/o equipamiento técnico según lo requiera y puede solicitar además acompañamiento gastronómico el cual lleva un costo adicional.', 'Precio'=>1714.08),
            array('Nombre'=>'MONTAJE DE FERIAS Y EXPOSICIONES', 'Descripcion'=>'Contamos con un equipo de montaje que se especializa en el montaje de exposiciones en lugares cerrados o abiertos ya sea en galerías o áreas habilitadas, ejecutando a través de planos y maquetas la decoración de diseños artísticos y trabajando en las tareas de carga, descarga y transportación de sus medios, velando por la integridad física de las obras.', 'Precio'=>1714.08),
            array('Nombre'=>'DISEÑO PROMOCIÓN Y PUBLICIDAD', 'Descripcion'=>'Trabajamos en el diseño de su imagen Corporativa, desarrollamos proyectos editoriales de Señalización, Envases, Publicidad y Audiovisuales así como los soportes de comunicación que operan en el plano, la secuencia y la tridimensional.', 'Precio'=>1714.08),
            array('Nombre'=>'ALQUILER DE MOBILIARIO, EQUIPOS Y CARRUAJES', 'Descripcion'=>'En nuestro centro contamos con mobiliario necesario para el montaje de un stand, exposición o feria, el cual usted podrá alquilar por un precio muy accesible necesitando solo disponer de un transporte para su traslado al lugar de destino.', 'Precio'=>1714.08),
            array('Nombre'=>'ALOJAMIENTO CON ALIMENTACIÓN ASOCIADA', 'Descripcion'=>'El Motel ¨El ganadero¨ es un sitio para el alojamiento en ocasión de un viaje de trabajo a la capital donde el buen trato en el servicio y el clima agradable se unen para el disfrute de un cliente como usted. Con 52 camas de alto confort, climatización en las habitaciones, televisión, refrigerador, muy limpia lencería y servicio gastronómico asociado con un precio adecuado.', 'Precio'=>0));

        //$Servicios = array("ALQUILER DE ESPACIOS", "MONTAJE DE FERIAS Y EXPOSICIONES", "DISEÑO PROMOCIÓN Y PUBLICIDAD", "ALQUILER DE MOBILIARIO, EQUIPOS Y CARRUAJES", "ALOJAMIENTO CON ALIMENTACIÓN ASOCIADA");


        foreach ($Servicios as $serv)
        {
            $ext=$repo->findBy(array('Nombre' => $serv['Nombre']));
            if($ext==null)
            {
                $entidad = new Servicio();
                $entidad->setNombre($serv['Nombre']);
                $entidad->setDescripcion($serv['Descripcion']);
                $entidad->setPrecio($serv['Precio']);

                $manager->persist($entidad);
            }

        }
        $manager->flush();

    }
}