<?php

namespace feriaagropecuaria\UsuarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use feriaagropecuaria\UsuarioBundle\Entity\Usuario;
use feriaagropecuaria\UsuarioBundle\Form\UsuarioType;

class UsuarioController extends Controller
{
    public function loginAction()
    {

        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        return $this->render('feriaagropecuariaUsuarioBundle:Usuario:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        ));

    }
    public function registroAction()
    {
        $entity = new Usuario();
        $form   = $this->createCreateForm($entity);
        return $this->render('feriaagropecuariaUsuarioBundle:Usuario:Registro.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function usuariosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaUsuarioBundle:Usuario')->findAll();

        return $this->render('feriaagropecuariaUsuarioBundle:Usuario:usuarios.html.twig', array(
            'entities' => $entities,
        ));
    }
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }

    public function createAction(Request $request)
    {
        $entity = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('feriaagropecuariaUsuarioBundle:Usuario:Registro.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /*public function logoutAction()
    {
        $this->container->get('security.context')->setToken(null);

        return $this->redirect($this->generateUrl('homepage'));
    }*/

}
