<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OrderIT\Bundle\OrderBundle\Entity\Comment;
use OrderIT\Bundle\OrderBundle\Form\CommentType;

/**
 * Comment controller.
 *
 * @Route("/comment")
 */
class CommentController extends Controller
{

    /**
     * Lists all Comment entities.
     *
     * @Route("/", name="comment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Comment')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Comment entity.
     *
     * @Route("/", name="comment_create")
     * @Method("POST")
     * @Template("OrderBundle:Comment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Comment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //récupère l'id de l'user courant
            $user = $this->container->get('security.context')->getToken()->getUser();
            $user = $user->getId();
            $user = $em->getRepository('OrderBundle:Localuser')->find($user);

            // Si la personne est un responsable la commande est directement validé à ce niveau
            if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {
                //récupère l'objet statut Validé par le responsable
                $status= $em->getRepository('OrderBundle:Status')->find(30);
                $entity->getListingListing()->getDemandDemand()->setValidRespIdUser($user);
            }
            //Si la personne est une personne du service comptable
            else if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')) {
                //récupère l'objet statut Validé par le comptable
                $status = $em->getRepository('OrderBundle:Status')->find(40);
                $entity->getListingListing()->getDemandDemand()->setValidAccouIdUser($user);
            }
            //Set de status
            $entity->getListingListing()->getDemandDemand()->setStatusstatus($status);
            $em->persist($entity);
            $em->flush();
            //Récupère l'id de la demande relative
            $idDemand = $entity->getListingListing()->getDemandDemand()->getIdDemand();
            //Set objet demand
            $demand = $em->getRepository('OrderBundle:Demand')->find($idDemand);
            //Récupère le mail des personnes ayant un role dans la demande
            $mail = $this->giveEmailDemand($demand);
            //Récupère le numéro de la commande
            $demandnumber = $demand->getNumeroDemand();
            //Récupère le commentaire
            $comment = $entity->getComment();
            //on constitue le sujet du mail
            $subject = 'La commande '.$demandnumber.' doit être modifié';
            //On décrit l'action accomplie pour le mail
            $action = "soumis à modification";
            //Renseigne sur qui a validé la demande
            $username = $user->getUsername();
            //On appelle la fonction qui envoie le mail
            $this->sendMail($subject,$mail,$demandnumber,$action, $username, $comment);


            return $this->redirect($this->generateUrl('comment_show', array('id' => $entity->getIdComment())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Comment entity.
     *
     * @param Comment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Comment entity.
     *
     * @Route("/{idlisting}/comment", name="comment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($idlisting)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Comment();
        //Set l'utilisateur courrant
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user = $user->getId();
        $user = $em->getRepository('OrderBundle:Localuser')->find($user);
        $entity->setIdUser($user);
        //Set l'id du listing correspondant au commentaire
        $listing = $em->getRepository('OrderBundle:Listing')->find($idlisting);
        $entity->setListingListing($listing);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Comment entity.
     *
     * @Route("/{id}", name="comment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     * @Route("/{id}/edit", name="comment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
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
    * Creates a form to edit a Comment entity.
    *
    * @param Comment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Comment entity.
     *
     * @Route("/{id}", name="comment_update")
     * @Method("PUT")
     * @Template("OrderBundle:Comment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OrderBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Comment entity.
     *
     * @Route("/{id}", name="comment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OrderBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comment'));
    }

    /**
     * Creates a form to delete a Comment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function sendMail($subject,$mail,$demandnumber,$action, $username, $comment){

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('orderit.donotreply@gmail.com')
            ->setTo($mail)
            ->setBody($this->renderView('OrderBundle:Mail:new.html.twig', array('demandnumber' => $demandnumber,
                'action' => $action,
                'username' => $username,
                'commentaire' => $comment)));
        $this->get('mailer')->send($message);
    }

    public function giveEmailDemand($demand){
        $mail = array();
        //Récupère mail relatif à la demande
        $em = $this->getDoctrine()->getManager();
        $demand = $em->getRepository('OrderBundle:Demand')->find($demand);
        //Si la demand a un createur
        if ($demand->getCreaIdUser()) {
            $user = $demand->getCreaIdUser();
            $user = $em->getRepository('OrderBundle:Localuser')->find($user);
            $mail[] = $user->getEmail();
        }
        //Si la demande à un responsable
        if ($demand->getValidRespIdUser()) {
            $user = $demand->getValidRespIdUser();
            $user = $em->getRepository('OrderBundle:Localuser')->find($user);
            $mail[] = $user->getEmail();
        }
        //Si la demande est attribuée à un memebre de la comptabilité
        if ($demand->getValidAccouIdUser()) {
            $user = $demand->getValidAccouIdUser();
            $user = $em->getRepository('OrderBundle:Localuser')->find($user);
            $mail[] = $user->getEmail();
        }

        return $mail;
    }

}
