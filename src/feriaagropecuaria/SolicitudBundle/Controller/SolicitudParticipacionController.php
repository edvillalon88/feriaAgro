<?php

namespace feriaagropecuaria\SolicitudBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use feriaagropecuaria\SolicitudBundle\Entity\Credencial;
use feriaagropecuaria\SolicitudBundle\Entity\Rechazo;
use feriaagropecuaria\SolicitudBundle\Entity\SolicitudProducto;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion;
use feriaagropecuaria\SolicitudBundle\Form\SolicitudParticipacionType;
use feriaagropecuaria\SolicitudBundle\Form\RechazoType;
use Symfony\Component\HttpFoundation\Response;

/**
 * SolicitudParticipacion controller.
 *
 */
class SolicitudParticipacionController extends Controller
{

    /**
     * Lists all SolicitudParticipacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->findAll();

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SolicitudParticipacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SolicitudParticipacion();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


            if($entity->getArea()->getIdArea() == 1)
            {
                return $this->redirect($this->generateUrl('solicitud_esquema', array('identificador' => $entity->getIdentificador())));

            }else
            {
                return $this->redirect($this->generateUrl('solicitud_participacion_show', array('identificador' => $entity->getIdentificador())));
            }

        }

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function esquemaAction($identificador)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->findOneBy(array('identificador' => $identificador));
        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:esquema.html.twig', array(
            'entity' => $entity,

        ));
    }

    public function guardarimgAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $verificar = 'false';

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($id);


        $name = $entity->getIdentificador().".jpg";


        //$_POST[data][1] has the base64 encrypted binary codes.
        //convert the binary to image using file_put_contents
        $savefile = @file_put_contents($entity->getUploadRootDir()."/".$name, base64_decode(explode(",", $request->get('data'))[1]));


        if($savefile)
        {

            $entity->setPath($name);
            $em->persist($entity);

            $em->flush();

            $verificar = 'true';
        }
        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:verificar.json.twig', array(
            'verificado'      => $verificar,
            'content/type' => 'text/json'

        ));
    }

    /**
     * Creates a form to create a SolicitudParticipacion entity.
     *
     * @param SolicitudParticipacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SolicitudParticipacion $entity)
    {
        $form = $this->createForm(new SolicitudParticipacionType(), $entity, array(
            'action' => $this->generateUrl('solicitud_participacion_create'),
            'method' => 'POST',
        ));



        $form->add('submit', 'submit', array('label' => 'Submit'));

        return $form;
    }

    /**
     * Displays a form to create a new SolicitudParticipacion entity.
     *
     */
    public function newAction()
    {
        $entity = new SolicitudParticipacion();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),

        ));
    }

    /**
     * Finds and displays a SolicitudParticipacion entity.
     *
     */
    public function showAction($identificador)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->findOneBy(array(
            'identificador' => $identificador
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getIdSolicitudParticipacion());

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:show.html.twig', array(
            'Cantidad'    =>$this->CantidadSolicitudes($entity),
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

   /*
    * Aprobar solicitud
    * */
    public function aprobarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }

        $editForm = $this->createEditForm($entity);



        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:aprobar.html.twig', array(
            'entity'      => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }


    public function aprobadaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }


       $apro=$request->request->get('valor');

       if($apro == 1)
       {

           $entity->setAprobada(true);

           $em->persist($entity);

           $em->flush();

            return $this->redirect($this->generateUrl('solicitud_participacion'));

        }else
        {

            return $this->redirect($this->generateUrl('solicitud_rechazo', array('idsolicitud' => $entity->getIdSolicitudParticipacion())));

        }

        return $this->redirect($this->generateUrl('solicitud_participacion_aprobar', array('id' => $entity->getIdSolicitudParticipacion())));
    }

    private function RechazoCreateform(Rechazo $entity, $idsolicitud)
    {
        $form = $this->createForm(new RechazoType(), $entity, array(
            'action' => $this->generateUrl('solicitud_rechazar', array('idsolicitud' => $idsolicitud)),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-primary')));;
        return $form;
    }
    public function rechazoAction($idsolicitud)
    {
        $entity = new Rechazo();

        $form = $this->RechazoCreateform($entity, $idsolicitud);

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:rechazar.html.twig', array(

            'form' => $form->createView(),
        ));
    }

    public function verificarAction(Request $request)
    {
        $identificador = $request->get("identificador");
        $em = $this->getDoctrine()->getManager();

        $solicitud = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->findOneBy(array(
            'identificador' => $identificador
        ));

        $verificar= 'false';
        if ($solicitud) {

            $verificar = 'true';
        }

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:verificar.json.twig', array(
            'verificado'      => $verificar

        ));
    }

    public function rechazarAction(Request $request, $idsolicitud)
    {
        $em = $this->getDoctrine()->getManager();

        $solicitud = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($idsolicitud);

        if (!$solicitud) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }

        $entity = new Rechazo();

        $form = $this->RechazoCreateform($entity, $idsolicitud);


        $form->handleRequest($request);

        $entity->setsolicitudParticipacion($solicitud);

        $texto = $entity->getDescripcion();

        try
        {
            $mensaje = \Swift_Message::newInstance()
                ->setSubject('Notificacion de Feria Agropecuaria')
                ->setFrom('feria.agro2016@gmail.com')
                ->setTo($solicitud->getEmail())
                ->setBody("Su solicitud ha sido rechazada por la siguiente razon: ".$texto);

            //$m = $this->get('mailer')->send($mensaje);
        }
        catch(Exception $e)
        {

        }



        $em->persist($entity);
        $em->flush();



        return $this->redirect($this->generateUrl('solicitud_participacion'));;

    }

    /**
     * Displays a form to edit an existing SolicitudParticipacion entity.
     *
     */
    private function CantidadSolicitudes($entity)
    {
        $metros = $entity->getMetros();
        if($metros >= 9 && $metros <= 15)
        {
            return 3;

        }
        else if($metros >= 16 && $metros <= 36)
        {
            return 4;
        }
        else if($metros >= 37 && $metros <= 50)
        {
            return 5;
        }
        else if($metros > 51)
        {
            return 6;
        }

    }
    public function editAction($identificador)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->findOneBy(array(
            'identificador' => $identificador
        ));



        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }

        $editForm = $this->createEditForm($entity);


        $Cantidad = 0;
        if($entity->getAprobada())
        {
            $Cantidad = $this->CantidadSolicitudes($entity);
        }




        $deleteForm = $this->createDeleteForm($entity->getIdSolicitudParticipacion());

        return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:edit.html.twig', array(
            'entity'      => $entity,
            'Cantidad'    => $Cantidad,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
    * Creates a form to edit a SolicitudParticipacion entity.
    *
    * @param SolicitudParticipacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SolicitudParticipacion $entity)
    {

        $form = $this->createForm(new SolicitudParticipacionType(), $entity, array(
            'action' => $this->generateUrl('solicitud_participacion_update', array('id' => $entity->getIdSolicitudParticipacion())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }

    /**
     * Edits an existing SolicitudParticipacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
        }



        $ProductosOriginales = new ArrayCollection();
        $credencialesOriginales = new ArrayCollection();

        foreach($entity->getSolicitudproductos() as $sp)
        {
            $ProductosOriginales->add($sp);
        }

        foreach($entity->getCredenciales() as $cr)
        {
            $credencialesOriginales->add($cr);
        }

        //$deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if($entity->getrechazo() != null)
        {
            $text = $entity->getIdentificador();

            try
            {
                $mensaje = \Swift_Message::newInstance()
                    ->setSubject('solicitu editada por rechazo')
                    ->setFrom('feria.agro2016@gmail.com')
                    ->setTo('feria.agro2016@gmail.com')
                    ->setBody("LA siguiente solicitud se edito para su comprobacion y posterior aceptacios. Identificador: ".$text);

                //$m = $this->get('mailer')->send($mensaje);

            }catch(Exception $e)
            {

            }


            $em->remove($entity->getrechazo());

        }

       // if ($editForm->isValid()) {
        foreach($ProductosOriginales as $osp)
        {
            if(false===$entity->getSolicitudproductos()->contains($osp))
            {
                //$osp->getSolicitudproductos()->removeElement($osp);

                // if it was a many-to-one relationship, remove the relationship like this
                // $tag->setTask(null);

                $em->remove($osp);
            }

        }
        //Este es para las credenciales-----
        foreach($credencialesOriginales as $cr)
        {
            if(false===$entity->getCredenciales()->contains($cr))
            {
                //$osp->getSolicitudproductos()->removeElement($osp);

                // if it was a many-to-one relationship, remove the relationship like this
                // $tag->setTask(null);

                $em->remove($cr);
            }

        }


        $em->flush();

        return $this->redirect($this->generateUrl('solicitud_participacion_show', array('identificador' => $entity->getIdentificador())));
         // }

        /*return $this->render('feriaagropecuariaSolicitudBundle:SolicitudParticipacion:show.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));*/
    }
    /**
     * Deletes a SolicitudParticipacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaSolicitudBundle:SolicitudParticipacion')->find($id);
            //$entity->ClearSP();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SolicitudParticipacion entity.');
            }

            $em->remove($entity);
            $em->flush();
            if (file_exists($entity->getAbsolutePath()) && $entity->getPath() != null) {
                unlink($entity->getAbsolutePath());
            }
        }

        return $this->redirect($this->generateUrl('feriaagropecuaria_home_homepage'));
    }

    /**
     * Creates a form to delete a SolicitudParticipacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('solicitud_participacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr'=>array('style'=>'width:100%')))
            ->getForm()
        ;
    }
}
