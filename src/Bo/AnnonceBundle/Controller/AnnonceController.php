<?php

namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Form\Type\AnnonceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{
    /**
     * @Route("/user/create_annonce", name="_add_annonce")
     * @Template()
     */
    public function createUserAction() {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new AnnonceType());

        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            
            $annonce = $form->getData();
            $annonce->setUser($this->getUser());
                                    
            $em->persist($annonce);
            $em->flush();

            return $this->redirect($this->generateUrl('_user_annonces'));
        }

        return $this->render('BoAnnonceBundle:Annonce:create.html.twig', array('form' => $form->createView()));
    }
}
