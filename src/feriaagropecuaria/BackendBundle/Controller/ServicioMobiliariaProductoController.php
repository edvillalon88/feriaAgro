<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\BackendBundle\Entity\ServicioMobiliariaProducto;
use feriaagropecuaria\BackendBundle\Form\ServicioMobiliariaProductoType;

/**
 * ServicioMobiliariaProducto controller.
 *
 */
class ServicioMobiliariaProductoController extends Controller
{

    /**
     * Lists all ServicioMobiliariaProducto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->findAll();

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ServicioMobiliariaProducto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ServicioMobiliariaProducto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('smp_show', array('id' => $entity->getIdServicioMobiliariaProducto())));
        }

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ServicioMobiliariaProducto entity.
     *
     * @param ServicioMobiliariaProducto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ServicioMobiliariaProducto $entity)
    {
        $form = $this->createForm(new ServicioMobiliariaProductoType(), $entity, array(
            'action' => $this->generateUrl('smp_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new ServicioMobiliariaProducto entity.
     *
     */
    public function newAction()
    {
        $entity = new ServicioMobiliariaProducto();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ServicioMobiliariaProducto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicioMobiliariaProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ServicioMobiliariaProducto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicioMobiliariaProducto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ServicioMobiliariaProducto entity.
    *
    * @param ServicioMobiliariaProducto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ServicioMobiliariaProducto $entity)
    {
        $form = $this->createForm(new ServicioMobiliariaProductoType(), $entity, array(
            'action' => $this->generateUrl('smp_update', array('id' => $entity->getIdServicioMobiliariaProducto())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update' ,'attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing ServicioMobiliariaProducto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicioMobiliariaProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('smp_edit', array('id' => $id)));
        }

        return $this->render('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ServicioMobiliariaProducto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:ServicioMobiliariaProducto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ServicioMobiliariaProducto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('smp'));
    }

    /**
     * Creates a form to delete a ServicioMobiliariaProducto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('smp_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
