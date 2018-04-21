<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\BackendBundle\Entity\FotoServicio;
use feriaagropecuaria\BackendBundle\Form\FotoServicioType;

/**
 * FotoServicio controller.
 *
 */
class FotoServicioController extends Controller
{

    /**
     * Lists all FotoServicio entities.
     *
     */
    private function Translate($entity, $manager, $DescripcionENG)
    {

        $id = $entity->getIdFotoServicio();
        $organization = $manager->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->find($id);

        $organization->setDescripcion($DescripcionENG);

        $organization->setTranslatableLocale('en');
        $manager->persist($organization);
        $manager->flush();
    }
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->findAll();

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FotoServicio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FotoServicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->Translate($entity, $em, $request->get('DescripcionENG'));
            return $this->redirect($this->generateUrl('fotoservicio_show', array('id' => $entity->getIdFotoServicio())));
        }

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FotoServicio entity.
     *
     * @param FotoServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FotoServicio $entity)
    {
        $form = $this->createForm(new FotoServicioType(), $entity, array(
            'action' => $this->generateUrl('fotoservicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new FotoServicio entity.
     *
     */
    public function newAction()
    {
        $entity = new FotoServicio();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FotoServicio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FotoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FotoServicio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FotoServicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FotoServicio entity.
    *
    * @param FotoServicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FotoServicio $entity)
    {
        $form = $this->createForm(new FotoServicioType(), $entity, array(
            'action' => $this->generateUrl('fotoservicio_update', array('id' => $entity->getIdFotoServicio())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing FotoServicio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FotoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->Translate($entity, $em, $request->get('DescripcionENG'));
            return $this->redirect($this->generateUrl('fotoservicio_edit', array('id' => $id)));
        }

        return $this->render('feriaagropecuariaBackendBundle:FotoServicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FotoServicio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:FotoServicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FotoServicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fotoservicio'));
    }

    /**
     * Creates a form to delete a FotoServicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fotoservicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
