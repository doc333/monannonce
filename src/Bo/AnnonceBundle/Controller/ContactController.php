<?php
namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
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