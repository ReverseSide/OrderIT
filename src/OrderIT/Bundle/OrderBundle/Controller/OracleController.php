<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OrderIT\Bundle\OrderBundle\Entity\Oracle;
use OrderIT\Bundle\OrderBundle\Form\OracleType;

/**
 * Oracle controller.
 *
 * @Route("/oracle")
 */
class OracleController extends Controller
{

    /**
     * Lists all Oracle entities.
     *
     * @Route("/", name="oracle")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Oracle')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Oracle entity.
     *
     * @Route("/", name="oracle_create")
     * @Method("POST")
     * @Template("OrderBundle:Oracle:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Oracle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oracle_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Oracle entity.
     *
     * @param Oracle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Oracle $entity)
    {
        $form = $this->createForm(new OracleType(), $entity, array(
            'action' => $this->generateUrl('oracle_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Oracle entity.
     *
     * @Route("/new", name="oracle_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Oracle();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Oracle entity.
     *
     * @Route("/{id}", name="oracle_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Oracle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oracle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Oracle entity.
     *
     * @Route("/{id}/edit", name="oracle_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Oracle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oracle entity.');
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
    * Creates a form to edit a Oracle entity.
    *
    * @param Oracle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Oracle $entity)
    {
        $form = $this->createForm(new OracleType(), $entity, array(
            'action' => $this->generateUrl('oracle_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Oracle entity.
     *
     * @Route("/{id}", name="oracle_update")
     * @Method("PUT")
     * @Template("OrderBundle:Oracle:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Oracle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oracle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('oracle_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Oracle entity.
     *
     * @Route("/{id}", name="oracle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrderBundle:Oracle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Oracle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('oracle'));
    }

    /**
     * Creates a form to delete a Oracle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oracle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
