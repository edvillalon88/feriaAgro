<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use feriaagropecuaria\HomeBundle\Entity\ViewModelPaginado;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\BackendBundle\Entity\Pais;
use feriaagropecuaria\BackendBundle\Form\PaisType;

/**
 * Pais controller.
 *
 */
class PaisController extends Controller
{

    /**
     * Lists all Pais entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();



        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Pais')->findAll();


        return $this->render('feriaagropecuariaBackendBundle:Pais:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pais entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pais();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pais_show', array('id' => $entity->getIdPais())));
        }

        return $this->render('feriaagropecuariaBackendBundle:Pais:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pais entity.
     *
     * @param Pais $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pais $entity)
    {
        $form = $this->createForm(new PaisType(), $entity, array(
            'action' => $this->generateUrl('pais_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Pais entity.
     *
     */
    public function newAction()
    {
        $entity = new Pais();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:Pais:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pais entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Pais:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pais entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Pais:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pais entity.
    *
    * @param Pais $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pais $entity)
    {
        $form = $this->createForm(new PaisType(), $entity, array(
            'action' => $this->generateUrl('pais_update', array('id' => $entity->getIdPais())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Pais entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Pais')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pais entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pais'));
        }

        return $this->render('feriaagropecuariaBackendBundle:Pais:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pais entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:Pais')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pais entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pais'));
    }

    /**
     * Creates a form to delete a Pais entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
