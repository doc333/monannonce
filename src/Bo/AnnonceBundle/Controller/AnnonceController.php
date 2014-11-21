<?php

namespace Bo\AnnonceBundle\Controller;

use Bo\AnnonceBundle\Entity\AnnonceUser;
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
    public function createAnonceAction() {
        if ($this->get('security.context')->isGranted('ROLE_ANNONCEUR')) {
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
        else{
            $url = $this->getRequest()->headers->get('referer');

            return $this->redirect($url);
        }
    }
    
    /**
     * @Route("/annonce/{id}", name="_voir_annonce")
     * @Template()
     */
	public function voirAnnonceAction($id)
	{
        $participe = true;
        $em= $this->getDoctrine()->getManager();
        
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $q = $em->getRepository('BoAnnonceBundle:AnnonceUser')->createQueryBuilder('a')
                ->where('a.user = :user')
                ->andWhere('a.annonce = :annonce')
                ->setParameter('user',  $this->getUser())
                ->setParameter('annonce', $em->getRepository('BoAnnonceBundle:Annonce')->find($id))
                ->getQuery()
                ->getOneOrNullResult();

            if(is_null($q)) {
                $participe = false;
            }
        }
                
        $annonce = $em->getRepository('BoAnnonceBundle:Annonce')->find($id);
        
        $participant = $em->getRepository('BoAnnonceBundle:AnnonceUser')->createQueryBuilder('au')
                ->select('COUNT(au.id)')
                ->where('au.annonce= :annonce')
                ->setParameter('annonce', $em->getRepository('BoAnnonceBundle:Annonce')->find($id))
                ->getQuery()
                ->getSingleScalarResult();
        
        $restePlace = $annonce->getNbrPlace()-$participant;
        
		return $this->render('BoAnnonceBundle:Annonce:voir.html.twig', array('annonce' => $annonce, 'participe' => $participe, 'restePlace' => $restePlace));
	}
    
    /**
     * @Route("/user/participer/{id}", name="_participer")
     * @Template()
     */
	public function participerAnnonceAction($id)
	{
        $em= $this->getDoctrine()->getManager();
        
        $participe = $em->getRepository('BoAnnonceBundle:AnnonceUser')->createQueryBuilder('a')
                ->where('a.user = :user')
                ->andWhere('a.annonce = :annonce')
                ->setParameter('user',  $this->getUser())
                ->setParameter('annonce', $em->getRepository('BoAnnonceBundle:Annonce')->find($id))
                ->getQuery()
                ->getOneOrNullResult();
        
        if(is_null($participe)){
            $participation = new AnnonceUser();
            $participation->setAnnonce($em->getRepository('BoAnnonceBundle:Annonce')->find($id));
            $participation->setUser($this->getUser());
            $participation->setNbrPersonne(1);

            $em->persist($participation);
            $em->flush();   
        }        
        $url = $this->getRequest()->headers->get('referer');

        return $this->redirect($url);
	}
    
    /**
     * @Route("/user/desinscrire/{id}", name="_desinscrire")
     * @Template()
     */
	public function desinscrireAnnonceAction($id)
	{
        $em= $this->getDoctrine()->getManager();
        $url = $this->getRequest()->headers->get('referer');
        
        $participe = $em->getRepository('BoAnnonceBundle:AnnonceUser')->createQueryBuilder('a')
                ->where('a.user = :user')
                ->andWhere('a.annonce = :annonce')
                ->setParameter('user',  $this->getUser())
                ->setParameter('annonce', $em->getRepository('BoAnnonceBundle:Annonce')->find($id))
                ->getQuery()
                ->getOneOrNullResult();
        
        if(is_null($participe)){
            return $this->redirect($url);
        } else {
            $qb= $em->createQueryBuilder();
            $qb->delete();
            $qb->from('BoAnnonceBundle:AnnonceUser', 'au');
            $qb->where($qb->expr()->eq('au.user', ':user'));
            $qb->setParameter('user',  $this->getUser());
            $qb->andWhere($qb->expr()->eq('au.annonce', ':annonce'));
            $qb->setParameter('annonce', $em->getRepository('BoAnnonceBundle:Annonce')->find($id));
            $qb->getQuery()->execute();
        }

        return $this->redirect($url);
	}
}
