<?php

namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
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
     * @Route("/user/annonces", name="_user_annonces")
     * @Template()
     */
    public function userAnnoncesAction()
    {
        
    }
    
    /**
     * @Route("/user/rdv", name="_user_rdv")
     * @Template()
     */
    public function userRdvAction()
    {
        
    }
    
    /**
     * @Route("/user/messages", name="_user_messages")
     * @Template()
     */
    public function userMessagesAction()
    {
        
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
     * @Route("/user/send_message/{uid}", name="_send_message")
     * @Template()
     */
    public function sendMessageAction($uid) {
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
            
            $user = $form->getData();
            
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->encodePass($encoder);
                        
            $em->persist($user);
            $em->flush();

            return $this->redirect('/user');
        }

        return $this->render('BoAnnonceBundle:Default:signup.html.twig', array('form' => $form->createView()));
    }
}
