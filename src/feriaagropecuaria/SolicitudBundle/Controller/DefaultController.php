<?php

namespace feriaagropecuaria\SolicitudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('feriaagropecuariaSolicitudBundle:Default:index.html.twig', array('name' => $name));
    }
}
