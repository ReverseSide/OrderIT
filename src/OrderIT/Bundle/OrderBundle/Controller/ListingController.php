<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OrderIT\Bundle\OrderBundle\Entity\Listing;
use OrderIT\Bundle\OrderBundle\Form\ListingType;



/**
 * Listing controller.
 *
 * @Route("/listing")
 *
 */
class ListingController extends Controller
{

    /**
     * Lists all Listing entities.
     *
     * @Route("/", name="listing")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Listing')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists my Demand entities.
     *
     * @Route("/my_demand", name="mydemand")
     * @Method("GET")
     * @Template("OrderBundle:Listing:index.html.twig")
     */
    public function MydemandAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Listing')->findAll();


        /**if (count($entities) > 1) {
            throw "Erreur";
        }**/

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Listing entity.
     *
     * @Route("/", name="listing_create")
     * @Method("POST")
     * @Template("OrderBundle:Listing:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Listing();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('listing_show', array('id' => $entity->getIdListing())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Listing entity.
     *
     * @param Listing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Listing $entity)
    {
        $form = $this->createForm(new ListingType(), $entity, array(
            'action' => $this->generateUrl('listing_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Listing entity.
     *
     * @Route("/new", name="listing_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Listing();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Listing entity.
     *
     * @Route("/{id}", name="listing_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Listing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Listing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds a Listing entity for create a pdf
     *
     * @Route("/{id}/pdf", name="listing_pdf")
     * @Method("GET")
     * @Template()
     */
    public function PdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Listing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Listing entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $html = $this->renderView('OrderBundle:Listing:pdf.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="demand'.$id.'.pdf"'
            )
        );
    }

    /**
     * Displays a form to edit an existing Listing entity.
     *
     * @Route("/{id}/edit", name="listing_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Listing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Listing entity.');
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
    * Creates a form to edit a Listing entity.
    *
    * @param Listing $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Listing $entity)
    {
        $form = $this->createForm(new ListingType(), $entity, array(
            'action' => $this->generateUrl('listing_update', array('id' => $entity->getIdListing())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Listing entity.
     *
     * @Route("/{id}", name="listing_update")
     * @Method("PUT")
     * @Template("OrderBundle:Listing:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Listing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Listing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('listing_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Listing entity.
     *
     * @Route("/{id}", name="listing_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrderBundle:Listing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Listing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('listing'));
    }

    /**
     * Creates a form to delete a Listing entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('listing_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

}
