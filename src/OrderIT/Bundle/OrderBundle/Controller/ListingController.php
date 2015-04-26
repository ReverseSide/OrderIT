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
        //Tout les personnes qui ne sont pas administrateur sont redirigée
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash(
                'danger',
                "Vous n'êties pas autorisé à accèder à cette page, vous avez été automatiquement redirigié"
            );
            return $this->redirect($this->generateUrl('default'));
        }
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OrderBundle:Listing')->findAll();

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
            //récuprer l'id de l'utilisateur courant
            $user = $this->container->get('security.context')->getToken()->getUser();
            $user = $user->getId();
            $em = $this->getDoctrine()->getManager();
            // Si la personne est un responsable la commande est directement validé à ce niveau
            if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {
                //récupère l'objet statut Validé par le responsable
                $status= $em->getRepository('OrderBundle:Status')->find(2);
            }
            else if ($this->get('security.context')->isGranted('ROLE_REQUIRING')) {
                //set le statut à 1
                $status = $em->getRepository('OrderBundle:Status')->find(1);
            }
            $entity->getDemandDemand()->setStatusstatus($status);
            $usercreat= $em->getRepository('OrderBundle:Localuser')->find($user);
            $entity->getDemandDemand()->setCreaIdUser($usercreat);
            $em->persist($entity);
            $em->flush();

            //set le listing current pour la demande
            $idlisting = $entity->getIdListing();
            $entity->getDemandDemand()->setidlisting($idlisting);

            //Cree le numero de commande avec l'acronyme et numero
            $acronyme = $this->generateAcronyme();


            $entity->getDemandDemand()->setNumeroDemand($acronyme);


            $em->persist($entity);
            $em->flush();
            //Redirection vers le nouvel enregistrement
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

        $form->add('submit', 'submit', array('label' => 'Créer'));

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
        //Tout les personnes qui ne sont pas validator ou accounting sont redirigée
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ACCOUNTING')) {
            $this->addFlash(
                'danger',
                "Vous n'êties pas autorisé à réaliser cette action, vous avez été automatiquement redirigié"
            );
            return $this->redirect($this->generateUrl('default'));
        }
        $em = $this->getDoctrine()->getManager();
        //Entity est égal à l'enregistrement $id
        $entity = $em->getRepository('OrderBundle:Listing')->find($id);
        //Si vide alors
        if (!$entity) {
            //Generation de l'erreur
            throw $this->createNotFoundException('Impossible de trouve cette demande');
        }
        $deleteForm = $this->createDeleteForm($id);
        //appel la vue twig pour formater pour les pdf
        $html = $this->renderView('OrderBundle:Listing:pdf.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
        //retourne le fichier pdf, il sera nommé "demand $id .pfd"
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

            $this->addFlash(
                'success',
                "La modification a été enregistrée avec succès "
            );

            return $this->redirect($this->generateUrl('listing_show', array('id' => $id)));
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


    /**
     * Fonction qui permet de générer l'acronyme et le numero de demande
     *
     *
     */
    public function generateAcronyme(){

        $em = $this->getDoctrine()->getManager();
        //récupère l'id de l'user courant
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user = $user->getId();
        $user = $em->getRepository('OrderBundle:Localuser')->find($user);
        //récupère son nom.prenom
        $username = $user->getUsername();
        //son prenom se trouve avant le .
        $lastname = strstr($username,'.');
        //Après le . on garde que le premier caractère du nom de famille
        $flettreoflastname = substr($lastname, 1, 1);
        //On garde que les deux premières lettres du prenom et le colle à la première lettre du nom de famille
        $acronyme = substr($username, 0, 2).$flettreoflastname;
        //On passe l'acronyme en majuscule
        $acronyme = strtoupper($acronyme);
        $resultat = count($em->getRepository('OrderBundle:Demand')->findBycreaIdUser($user));
        //Complete pour que la chaine de chiffre fasse 5 avec des 0
        $number = str_pad($resultat, 5, "0", STR_PAD_LEFT);
        return $acronyme.$number;
    }
}
