<?php

namespace Bo\AnnonceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
        
        $response = new Response($this->render('BoAnnonceBundle:Annonce:accueil.html.twig', array('annonces' => $annonces)));
        $response->setPublic();
        $response->setSharedMaxAge(600);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->setETag(md5($response->getContent()));
        $response->isNotModified($this->getRequest());
        
		return $response;
	}
}
