<?php

namespace feriaagropecuaria\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('feriaagropecuariaUsuarioBundle:Default:index.html.twig', array('name' => $name));
    }
}
