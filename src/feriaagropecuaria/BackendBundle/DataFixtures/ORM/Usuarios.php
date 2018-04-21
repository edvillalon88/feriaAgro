<?php
/**
 * Created by PhpStorm.
 * User: eduardo.valdes
 * Date: 15/03/2016
 * Time: 12:23
 */

namespace feriaagropecuaria\BackendBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Proxies\__CG__\feriaagropecuaria\UsuarioBundle\Entity\Usuario;

/**
 * Created by PhpStorm.
 * User: eduardo.valdes
 * Date: 15/03/2016
 * Time: 11:40
 */
class Usuarios implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

            $repo = $manager->getRepository('feriaagropecuariaUsuarioBundle:Usuario');

            $ext=$repo->findBy(array('Usuario' => 'admin'));
            if($ext == null)
            {

                $entidad = new Usuario();

                $entidad->setUsuario("admin");
                $entidad->setSalt(md5(uniqid()));
                // the 'security.password_encoder' service requires Symfony 2.6 or higher
                $encoder = $this->container->get('security.encoder_factory');
                $password = $encoder->getEncoder($entidad)->encodePassword("Admin2016", null);
                $entidad->setPassword($password);

                $manager->persist($entidad);
                $manager->flush();
            }


    }
}