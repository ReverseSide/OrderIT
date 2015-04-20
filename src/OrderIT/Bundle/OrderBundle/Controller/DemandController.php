<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OrderIT\Bundle\OrderBundle\Entity\Demand;
use OrderIT\Bundle\OrderBundle\Form\DemandType;

/**
 * Demand controller.
 *
 * @Route("/demand")
 */
class DemandController extends Controller
{

    /**
     * Lists all Demand entities.
     *
     * @Route("/", name="demand")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Demand')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Demand entity.
     *
     * @Route("/", name="demand_create")
     * @Method("POST")
     * @Template("OrderBundle:Demand:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Demand();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('demand_show', array('id' => $entity->getIdDemand())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Demand entity.
     *
     * @param Demand $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Demand $entity)
    {
        $form = $this->createForm(new DemandType(), $entity, array(
            'action' => $this->generateUrl('demand_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Demand entity.
     *
     * @Route("/new", name="demand_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Demand();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Demand entity.
     *
     * @Route("/{id}", name="demand_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Demand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Demand entity.
     *
     * @Route("/{id}/edit", name="demand_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Demand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
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
    * Creates a form to edit a Demand entity.
    *
    * @param Demand $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Demand $entity)
    {
        $form = $this->createForm(new DemandType(), $entity, array(
            'action' => $this->generateUrl('demand_update', array('id' => $entity->getIdDemand())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Demand entity.
     *
     * @Route("/{id}", name="demand_update")
     * @Method("PUT")
     * @Template("OrderBundle:Demand:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Demand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('demand_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Valid a Demand entity.
     *
     * @Route("/{idDemand}/valid", name="demand_valid")
     * @Method("GET")
     */
    public function validAction($idDemand)
    {
        $em = $this->getDoctrine()->getManager();
        $demand = $em->getRepository('OrderBundle:Demand')->find($idDemand);
        if (!$demand) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        // Si la personne est un responsable
        if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {

            $status= $em->getRepository('OrderBundle:Status')->find(2);
            if (!$status) {
                $status = new Status();
                $status.setId(2);
            }

            $demand->setStatusstatus($status);
            $em->persist($demand);
            $em->flush();
        }

        //Si la personne est une personne du service comptable
        else if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')) {

            $status= $em->getRepository('OrderBundle:Status')->find(3);
            if (!$status) {
                $status = new Status();
                $status.setId(3);
            }

            $demand->setStatusstatus($status);
            $em->persist($demand);
            $em->flush();
        }

        else {

            throw $this->createNotFoundException('Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        return $this->redirect($this->generateUrl('listing'));
    }

    /**
     * Refus a Demand entity.
     *
     * @Route("/{idDemand}/refus", name="demand_refus")
     * @Method("GET")
     */
    public function RefusAction($idDemand)
    {
        $em = $this->getDoctrine()->getManager();
        $demand = $em->getRepository('OrderBundle:Demand')->find($idDemand);
        if (!$demand) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        $status= $em->getRepository('OrderBundle:Status')->find(20);
        if (!$status) {
            $status = new Status();
            $status.setId(20);
            /** or new Status(20) depends on your implementation */
        }

        $demand->setStatusstatus($status);
        $em->persist($demand);
        $em->flush();
        return $this->redirect($this->generateUrl('listing'));
    }

    /**
     * Deletes a Demand entity.
     *
     * @Route("/{idDemand}/delete", name="demand_delete")
     * @Method("GET")
     */
    public function deleteAction($idDemand)
    {
        $em = $this->getDoctrine()->getManager();
        $demand = $em->getRepository('OrderBundle:Demand')->find($idDemand);
        if (!$demand) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        $status= $em->getRepository('OrderBundle:Status')->find(100);
        if (!$status) {
            $status = new Status();
            $status.setId(100);
            /** or new Status(20) depends on your implementation */
        }

        $demand->setStatusstatus($status);
        $em->persist($demand);
        $em->flush();
        return $this->redirect($this->generateUrl('listing'));
    }

    /**
     * Creates a form to delete a Demand entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demand_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
