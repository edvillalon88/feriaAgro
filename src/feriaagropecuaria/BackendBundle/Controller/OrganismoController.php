<?php

namespace feriaagropecuaria\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use feriaagropecuaria\BackendBundle\Entity\Organismo;
use feriaagropecuaria\BackendBundle\Form\OrganismoType;

/**
 * Organismo controller.
 *
 */
class OrganismoController extends Controller
{

    /**
     * Lists all Organismo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('feriaagropecuariaBackendBundle:Organismo')->findAll();

        return $this->render('feriaagropecuariaBackendBundle:Organismo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Organismo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Organismo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            // Traducir los contenidos de la oferta al inglés
            $this->Translate($entity, $em,$request->get("NombreENG"));
            return $this->redirect($this->generateUrl('organismo_show', array('id' => $entity->getIdOrganismo())));
        }

        return $this->render('feriaagropecuariaBackendBundle:Organismo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    private function Translate($entity, $manager,$NombreENG)
    {

        $id = $entity->getIdOrganismo();
        $organization = $manager->getRepository('feriaagropecuariaBackendBundle:Organismo')->find($id);
        $organization->setNombre($NombreENG);

        $organization->setTranslatableLocale('en');
        $manager->persist($organization);
        $manager->flush();
    }
    /**
     * Creates a form to create a Organismo entity.
     *
     * @param Organismo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organismo $entity)
    {
        $form = $this->createForm(new OrganismoType(), $entity, array(
            'action' => $this->generateUrl('organismo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Organismo entity.
     *
     */
    public function newAction()
    {
        $entity = new Organismo();
        $form   = $this->createCreateForm($entity);

        return $this->render('feriaagropecuariaBackendBundle:Organismo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Organismo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Organismo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organismo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Organismo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organismo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Organismo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organismo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('feriaagropecuariaBackendBundle:Organismo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Organismo entity.
    *
    * @param Organismo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Organismo $entity)
    {
        $form = $this->createForm(new OrganismoType(), $entity, array(
            'action' => $this->generateUrl('organismo_update', array('id' => $entity->getIdOrganismo())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Organismo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('feriaagropecuariaBackendBundle:Organismo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organismo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->Translate($entity, $em,$request->get("NombreENG"));
            return $this->redirect($this->generateUrl('organismo_edit', array('id' => $id)));
        }

        return $this->render('feriaagropecuariaBackendBundle:Organismo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Organismo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('feriaagropecuariaBackendBundle:Organismo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organismo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organismo'));
    }

    /**
     * Creates a form to delete a Organismo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organismo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
