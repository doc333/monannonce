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
		return $this->render('::base.html.twig', array());
	}
}
