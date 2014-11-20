<?php

namespace Bo\AnnonceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/accueil", name="_accueil")
     * @Template()
     */
	public function accueilAction()
	{
        $em= $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('BoAnnonceBundle:Annonce')->findBy(array('isActive'=>1, 'isRefuser'=>0),array(), 10, 0);
		return $this->render('BoAnnonceBundle:Annonce:accueil.html.twig', array('annonces' => $annonces));
	}
}
