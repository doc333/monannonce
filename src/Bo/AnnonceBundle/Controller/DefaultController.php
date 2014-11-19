<?php

namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Form\RegistrationType;
use Bo\AnnonceBundle\Form\Type\UserType;
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
	public function testAction()
	{
		return $this->render('::base.html.twig', array());
	}
    
    /**
     * @Route("/user", name="_user")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return array('username' => $user->getUsername());
    }
    /**
     * @Route("/user/coucou", name="user.coucou")
     * @Template()
     */
    public function testuserAction()
    {
        $user = $this->getUser();
        
        return new Response('<body>rrrrr</body>');
    }
    

    /**
     * @Route("/signup", name="_signup")
     * @Template()
     */
    public function signUpAction() {
        $form = $this->createForm(new UserType());

        return $this->render('BoAnnonceBundle:Default:signup.html.twig', array('form' => $form->createView()));
    
    }
    
    /**
     * @Route("/signup_create", name="_create")
     * @Template()
     */
    public function createUserAction() {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new UserType());

        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            
            $registration = $form->getData();
            $user = $registration->getUser();
            
            /*$factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->encodePass($encoder);*/
                        
            $em->persist($user);
            $em->flush();

            return $this->redirect('_created');
        }

        return $this->render('BoAnnonceBundle:Default:signup.html.twig', array('form' => $form->createView()));
    }
}
