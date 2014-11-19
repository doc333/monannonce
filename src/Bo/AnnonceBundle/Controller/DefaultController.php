<?php

namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Form\RegistrationType;
use Bo\AnnonceBundle\Form\Type\ContactType;
use Bo\AnnonceBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="_test")
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
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $request;
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('BoAnnonceBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
    
    /**
     * @Route("/user_check", name="_login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
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

        $form = $this->createForm(new RegistrationType());

        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            
            $registration = $form->getData();
            $user = $registration->getUser();
            
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->encodePass($encoder);
                        
            $em->persist($user);
            $em->flush();

            return $this->redirect('_created');
        }

        return $this->render('BoAnnonceBundle:Default:signup.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route("/contact", name="_contact")
     * @Template()
     */
    public function contactAction() {
        $request = $this->getRequest();
        $defaultData = array();
        
        $form = $this->createForm(new ContactType(), $defaultData);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Les données sont un tableau avec les clés "name", "email", et "message"
            $data = $form->getData();
            $subject = 'Mail Contact '.$data['civilite'].' '.$data['nom'].' '.$data['prenom'];
            $emailFrom = $data['email'];
            $emailTo = $this->container->getParameter('email_admin');
            $message = $data['message'];
            $fileAttachement = $data['fileImgUpload'];
            $fileAttachement2 = $data['fileImgUpload2'];
            
            $mailerContact = $this->get('contact_mail');
            $mailerContact->prepareMail($this->get('mailer'), $subject, $emailFrom, $emailTo, $message);
            $mailerContact->setFileAttachement($fileAttachement->getPathName(), $fileAttachement->getClientOriginalName());
            $mailerContact->setFileAttachement($fileAttachement2->getPathName(), $fileAttachement2->getClientOriginalName());

            if($mailerContact->send()){
                return $this->redirect($this->generateUrl('admin.email_ok'));
            }
            else{
                throw $this->createNotFoundException('email non envoyé');
            }
        }
        
        return $this->render('BoAnnonceBundle:Contact:form_contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/email_ok", name="admin.email_ok")
     * @Template()
     */
    public function email_okAction(){
        return array();
    }
}
