<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\lignecmd;
use CommandeBundle\Form\lignecmdType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class lignecomController extends Controller
{

    public function afficherLigneClientAction()
    {
        $usr=$this->get('security.token_storage')->getToken()->getUser();
        $lignecmd=$this->getDoctrine()->getRepository(lignecmd::class)->findBy(array('userid'=>$usr));
        //$em=$this->getDoctrine()->getManager();
        //$lignecmd = $em->getRepository(lignecmd::class)->findAll();

        return $this->render("@Commande/ligne/afficheL.html.twig",array("lignecmd"=>$lignecmd));
    }

    public function supprimerLigneClientAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $lignecmd = $em->getRepository(lignecmd::class)->find($id);
        $em->remove($lignecmd);
        $em->flush();
        return $this->redirectToRoute('lignecommande_affiche_client');
    }

    public function afficheLigneAdminAction()
    {
        $em=$this->getDoctrine()->getManager();
        $ligne=$em->getRepository("CommandeBundle:lignecmd")->findAll();
        return $this->render("@Commande/Ligne/afficheLigneAdmin.html.twig",array("ligne"=>$ligne));
    }

}
