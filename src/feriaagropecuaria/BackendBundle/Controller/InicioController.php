<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InicioController extends Controller
{
    public function indexAction()
    {
        return $this->render('feriaagropecuariaBackendBundle:Inicio:index.html.twig', array(
                // ...
            ));    }

}
