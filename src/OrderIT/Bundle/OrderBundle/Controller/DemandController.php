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
     * Lists all Listing "open" entities.
     *
     * @Route("/open", name="demand_open")
     * @Method("GET")
     * @Template("OrderBundle:Demand:index.html.twig")
     */
    public function OpenAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Si l'utilisateur est un reponsable alors
        if ($this->get('security.authorization_checker')->isGranted('ROLE_VALIDATOR')) {
            //Entities est égal à toute les demandes uniqement soumise par une requérant
            $entities = $em->getRepository('OrderBundle:Demand')->findBystatusstatus(1);}
        //Si l'utilisateur est une personne de la comptabilité alors
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ACCOUNTING')) {
            //Entites est égal à toute les demandes qui ont été validé par le reponsable
            $entities = $em->getRepository('OrderBundle:Demand')->findBystatusstatus(2);}

        //Si il n'y aucun demande
        if (count($entities) > 1) {
            throw new NotFoundHttpException("Il n'y a pas le moment pas de demande ouverte");
        }
        return array(
            //Renvoie les entities
            'entities' => $entities,
        );
    }

    /**
     * Lists all Listing "MyValidation" entities.
     *
     * @Route("/my_validation", name="my_validation")
     * @Method("GET")
     * @Template("OrderBundle:Demand:index.html.twig")
     */
    public function MyValidationAction()
    {
        //On récupère l'id de l'utilisateur courrant
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();
        $em = $this->getDoctrine()->getManager();
        //Si l'utilisateur courrant est un responsable alors
        if ($this->get('security.authorization_checker')->isGranted('ROLE_VALIDATOR')) {
            //Entites est égal à tout les demandes dont le champ validRespIdUser est l'utilisateur courrant
            $entities = $em->getRepository('OrderBundle:Demand')->findByvalidRespIdUser($user);}
        //Si l'utilisateur courrant est un comptable alors
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ACCOUNTING')) {
            //Entites est égal à tout les demandes dont le champ AccouIdUser est l'utilisateur courrant
            $entities = $em->getRepository('OrderBundle:Demand')->findByvalidAccouIdUser($user);}

        //Si il n'y a pas de demande
        if (count($entities) > 1) {
            throw new NotFoundHttpException("Vous n'avez pas encore validé des demandes");
        }

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Listing "Need modification" entities.
     *
     * @Route("/need_modification", name="need_modification")
     * @Method("GET")
     * @Template("OrderBundle:Demand:index.html.twig")
     */
    public function NeedModificationAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Demand')->findBycreaIdUser($user);


        /**if (count($entities) > 1) {
        throw "Erreur";
        }**/

        return array(
            'entities' => $entities,
        );
    }


    /**
     * Lists my Demand entities.
     *
     * @Route("/my_demand", name="mydemand")
     * @Method("GET")
     * @Template("OrderBundle:Demand:index.html.twig")
     */
    public function MydemandAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->getId();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Demand')->findBycreaIdUser($user);


        /**if (count($entities) > 1) {
        throw "Erreur";
        }**/

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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user = $user->getId();
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
        }
        //Si la personne est une personne du service comptable
        else if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')) {

            $status= $em->getRepository('OrderBundle:Status')->find(3);
            if (!$status) {
                $status = new Status();
                $status.setId(3);
            }
        }
        else {

            throw $this->createNotFoundException('Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        $demand->setStatusstatus($status);
        $em->persist($demand);
        $em->flush();
        if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {
            //Set champ localuser_acc_id_user avec l'id de l'utilisateur courrant
            $demand->setValidAccouIdUser($user);
        }
        if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')){
            //Set champ localuser_resp_id_user avec l'id de l'utilisateur courrant
            $demand->setValidRespIdUser($user);
        }
        $em->persist($demand);
        $em->flush();

        //Redirection vers mes listes
        return $this->redirect($this->generateUrl('my_validation'));
    }

    /**
     * Ask to modifie a Demand entity.
     *
     * @Route("/{idDemand}/requestmod", name="demand_requestmod")
     * @Method("GET")
     */
    public function RequestModAction($idDemand)
    {
        $em = $this->getDoctrine()->getManager();
        $demand = $em->getRepository('OrderBundle:Demand')->find($idDemand);
        if (!$demand) {
            throw $this->createNotFoundException('Unable to find Demand entity.');
        }

        // Si la personne est un responsable
        if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {

            $status = $em->getRepository('OrderBundle:Status')->find(30);
            if (!$status) {
                $status = new Status();
                $status.setId(30);
            }
        }

        //Si la personne est une personne du service comptable
        if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')) {
            $status = $em->getRepository('OrderBundle:Status')->find(40);
            if (!$status) {
                $status = new Status();
                $status.setId(40);
                /** or new Status(20) depends on your implementation */
            }
        }

        $demand->setStatusstatus($status);
        $em->persist($demand);
        $em->flush();
        return $this->redirect($this->generateUrl('//comment_new'));
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

    public function MailAction(){

        $idRequiring = $demand->getCreaIdUser();
        $mail = $em->getRepository('OrderBundle:Localuser')->find($idRequiring);
        $mail = getEmail($mail);
        $sendto = $mail;


        $message = \Swift_Message::newInstance()
            ->setSubject('Validation de la commande '.$idDemand)
            ->setFrom('orderit.donotreply@gmail.com')
            ->setTo($sendto)
            ->setBody($this->renderView('OrderBundle:Demand.email.txt.twig', array('idDemand' => $idDemand, 'corps' => 'La demande a été validé')));
        $this->get('mailer')->send($message);

    }

}
