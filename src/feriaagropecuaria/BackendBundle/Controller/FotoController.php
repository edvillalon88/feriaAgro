<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use feriaagropecuaria\BackendBundle\Entity\Foto;
use feriaagropecuaria\BackendBundle\Form\FotoType;

/**
 * Foto controller.
 *
 */
class FotoController extends Controller
{

    /**
     * Lists all Foto entities.
     *
     */
    private function Translate($entity, $manager,$DescripcionENG)
    {

        $id = $entity->getIdFichero();
        $organization = $manager->getRepository('feriaagropecuariaBackendBundle:Foto')->find($id);
        $organization->setDescripcion($DescripcionENG);

        $organization->setTranslatableLocale('en');
        $manager->persist($organization);
        $manager->flush();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->findAll();

        return $this->render('feriaagropecuariaBackendBundle:Foto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Foto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Foto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->Translate($entity, $em, $request->get('DescripcionENG'));

            return $this->redirect($this->generateUrl('foto_show', array('id' => $entity->getIdFichero())));
        }

        return $this->render('feriaagropecuariaBackendBundle:Foto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Foto entity.
     *
     * @param Foto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Foto $entity)
    {
        $form = $this->createForm(new FotoType(), $entity, array(
            'action' => $this->generateUrl('foto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' =>'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Foto entity.
     *
     */
    public function newAction()
    {
        $entity = new Foto();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:Foto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Foto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Foto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Foto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Foto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Foto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Foto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Foto entity.
    *
    * @param Foto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Foto $entity)
    {
        $form = $this->createForm(new FotoType(), $entity, array(
            'action' => $this->generateUrl('foto_update', array('id' => $entity->getIdFichero())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' =>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Foto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Foto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->Translate($entity, $em, $request->get('DescripcionENG'));
            return $this->redirect($this->generateUrl('foto_edit', array('id' => $id)));
        }

        return $this->render('feriaagropecuariaBackendBundle:Foto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Foto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:Foto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Foto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('foto'));
    }

    /**
     * Creates a form to delete a Foto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('foto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
