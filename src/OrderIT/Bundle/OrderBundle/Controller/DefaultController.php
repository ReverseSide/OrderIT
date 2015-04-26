<?php

namespace OrderIT\Bundle\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @Template()
     */
    public function indexAction()
    {

        if ($this->get('security.context')->isGranted('ROLE_REQUIRING')) {
            return $this->redirect($this->generateUrl('mydemand'));
        }
        if ($this->get('security.context')->isGranted('ROLE_VALIDATOR')) {
            return $this->redirect($this->generateUrl('demand_open'));
        }
        if ($this->get('security.context')->isGranted('ROLE_ACCOUNTING')) {
            return $this->redirect($this->generateUrl('demand_open'));
        }
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $this->addFlash(
                'warning',
                "Vous n'étes pas autorisé à vous connecter pour le moment, veuillez contacter l'administrateur"
            );
            return $this->redirect($this->generateUrl('fos_user_security_logout'));
        }

    }
}
