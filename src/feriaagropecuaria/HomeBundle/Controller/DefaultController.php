<?php

namespace feriaagropecuaria\HomeBundle\Controller;

use feriaagropecuaria\HomeBundle\Entity\Contacto;
use feriaagropecuaria\HomeBundle\Entity\ViewModelPaginado;
use feriaagropecuaria\HomeBundle\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use feriaagropecuaria\BackendBundle\Entity\ServicioMobiliariaProducto;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Servicio')->findAll();
        $queryevents = $em->createQuery("SELECT event FROM feriaagropecuariaBackendBundle:Evento event  ORDER BY event.idEvento DESC ")->setFirstResult(0)->setMaxResults(1);
        $evento = $queryevents->getResult();
        return $this->render('feriaagropecuariaHomeBundle:Default:index.html.twig', array(
            'entities' => $entities,
            'evento' => $evento[0]

        ));
    }

    public function productosAction($pagina)
    {


        $viewModel = $this->PaginadoProducto($pagina);

        return $this->render('feriaagropecuariaHomeBundle:Default:productos.html.twig', array(
            'entities' => $viewModel

        ));
    }

    public function productoAction($pagina)
    {


        $viewModel = $this->PaginadoProducto($pagina);

        return $this->render('feriaagropecuariaHomeBundle:Default:producto.html.twig', array(
            'entities' => $viewModel

        ));
    }

    private function PaginadoProducto($pagina)
    {
        $em = $this->getDoctrine()->getManager();
        $viewModel = new ViewModelPaginado();
        $cant = count($em->getRepository('feriaagropecuariaBackendBundle:Producto')->findAll());
        $entiti = $em->getRepository('feriaagropecuariaBackendBundle:Producto')->findBy(array(),
            array(),
            1, // 10 resultados
            $pagina // empezando en la posición 0
        );
        $viewModel->setCantidad($cant);
        foreach ($entiti as $en) {

            $viewModel->setProducto($en);
        }



        return $viewModel;
    }
    public function servicioAction($pagina)
    {
        $entities = null;
        if($pagina == "admin")
        {
            return $this->redirect($this->generateUrl("_index"));
        }

        if($pagina == "fiagrop")
        {
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('feriaagropecuariaBackendBundle:Servicio')->findAll();
        }

        return $this->render('feriaagropecuariaHomeBundle:Default:'.$pagina.'.html.twig', array(
            'entities' => $entities

        ));
    }

    public function tourAction($lugar)
    {
        return $this->render('feriaagropecuariaHomeBundle:Default:tour.html.twig', array(
            'lugar'      => $lugar

        ));
    }

    public function tarifasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->findAll();

        return $this->render('feriaagropecuariaHomeBundle:Default:tarifas.html.twig', array(
            'entities' => $entities,
        ));

    }

    public function renderviewAction($lugar)
    {

            return $this->render('feriaagropecuariaHomeBundle:Default:'.$lugar.'.html.twig');


    }

    public function contactoAction()
    {

        $entity = new Contacto();

        $form =$this->CrearForm($entity);

        return $this->render('feriaagropecuariaHomeBundle:Default:contacto.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    private function CrearForm(Contacto $entity)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('feriaagropecuaria_home_enviar_contacto'),
            'method' => 'POST',
            'attr'=>array('class'=>'form-horizontal')
        ));
        return $form;
    }

    public function sendcorreoAction(Request $request)
    {

        $entity = new Contacto();
        $form =$this->CrearForm($entity);

        //en este metodo pasa los valores de los campos del formulario a la entidad
        $form->handleRequest($request);
        //-----------------------------------------

        /*if($form->isValid())
        {*/
          $mensaje = \Swift_Message::newInstance()
                ->setSubject('Formulario de contacto')
                ->setFrom($entity->getEmail())
                ->setTo('feria.agro2016@gmail.com')
                ->setBody($entity->getTexto());
            try
            {

               // $this->get('mailer')->send($mensaje);

            }catch(Exception $e)
            {
                $exe = $e;
            }

        return $this->redirect($this->generateUrl('feriaagropecuaria_home_homepage'));

       /* }*/

       /* return $this->render('feriaagropecuariaHomeBundle:Default:contacto.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));*/


    }

    public function galeriaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Album')->findAll();
        return $this->render('feriaagropecuariaHomeBundle:Default:galeria.html.twig', array(
            'entities' => $entities
        ));
    }

    public function cargarfotosAction($idAlbum)
    {
        $em = $this->getDoctrine()->getManager();
        $album = $em->getRepository('feriaagropecuariaBackendBundle:Album')->find($idAlbum);
        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->findBy(array('Album' => $idAlbum));
        return $this->render('feriaagropecuariaHomeBundle:Default:fotos.html.twig', array(
            'entities' => $entities,
            'album' => $album
        ));
    }

}
