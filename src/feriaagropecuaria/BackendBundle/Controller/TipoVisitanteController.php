<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\BackendBundle\Entity\TipoVisitante;
use feriaagropecuaria\BackendBundle\Form\TipoVisitanteType;

/**
 * TipoVisitante controller.
 *
 */
class TipoVisitanteController extends Controller
{

    /**
     * Lists all TipoVisitante entities.
     *
     */
    private function Translate($entity, $manager,$NombreENG)
    {

        $id = $entity->getIdTipoVisitante();
        $organization = $manager->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->find($id);
        $organization->setNombre($NombreENG);

        $organization->setTranslatableLocale('en');
        $manager->persist($organization);
        $manager->flush();
    }
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->findAll();

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoVisitante entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoVisitante();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->Translate($entity, $em,$request->get('NombreENG'));
            return $this->redirect($this->generateUrl('tipovisitante_show', array('id' => $entity->getIdTipoVisitante())));
        }

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoVisitante entity.
     *
     * @param TipoVisitante $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoVisitante $entity)
    {
        $form = $this->createForm(new TipoVisitanteType(), $entity, array(
            'action' => $this->generateUrl('tipovisitante_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoVisitante entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoVisitante();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoVisitante entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoVisitante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoVisitante entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoVisitante entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoVisitante entity.
    *
    * @param TipoVisitante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoVisitante $entity)
    {
        $form = $this->createForm(new TipoVisitanteType(), $entity, array(
            'action' => $this->generateUrl('tipovisitante_update', array('id' => $entity->getIdTipoVisitante())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoVisitante entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoVisitante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->Translate($entity, $em,$request->get('NombreENG'));
            return $this->redirect($this->generateUrl('tipovisitante_edit', array('id' => $id)));
        }

        return $this->render('feriaagropecuariaBackendBundle:TipoVisitante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoVisitante entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:TipoVisitante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoVisitante entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipovisitante'));
    }

    /**
     * Creates a form to delete a TipoVisitante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipovisitante_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
