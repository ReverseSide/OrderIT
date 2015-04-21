<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OrderIT\Bundle\OrderBundle\Entity\Costcentre;
use OrderIT\Bundle\OrderBundle\Form\CostcentreType;

/**
 * Costcentre controller.
 *
 * @Route("/costcentre")
 */
class CostcentreController extends Controller
{

    /**
     * Lists all Costcentre entities.
     *
     * @Route("/", name="costcentre")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Costcentre')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Costcentre entity.
     *
     * @Route("/", name="costcentre_create")
     * @Method("POST")
     * @Template("OrderBundle:Costcentre:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Costcentre();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('costcentre_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Costcentre entity.
     *
     * @param Costcentre $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Costcentre $entity)
    {
        $form = $this->createForm(new CostcentreType(), $entity, array(
            'action' => $this->generateUrl('costcentre_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Costcentre entity.
     *
     * @Route("/new", name="costcentre_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Costcentre();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Costcentre entity.
     *
     * @Route("/{id}", name="costcentre_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Costcentre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Costcentre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Costcentre entity.
     *
     * @Route("/{id}/edit", name="costcentre_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Costcentre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Costcentre entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Costcentre entity.
    *
    * @param Costcentre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Costcentre $entity)
    {
        $form = $this->createForm(new CostcentreType(), $entity, array(
            'action' => $this->generateUrl('costcentre_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Costcentre entity.
     *
     * @Route("/{id}", name="costcentre_update")
     * @Method("PUT")
     * @Template("OrderBundle:Costcentre:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Costcentre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Costcentre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('costcentre_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Costcentre entity.
     *
     * @Route("/{id}", name="costcentre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrderBundle:Costcentre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Costcentre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('costcentre'));
    }

    /**
     * Creates a form to delete a Costcentre entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('costcentre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
