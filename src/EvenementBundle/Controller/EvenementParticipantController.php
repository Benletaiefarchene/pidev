<?php


namespace EvenementBundle\Controller;


use BaseBundle\Entity\ListP;
use BaseBundle\Entity\Utilisateur;
use EvenementBundle\Entity\Categorie;
use EvenementBundle\Entity\Evenement;
use AppBundle\Entity\User;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementParticipantController extends Controller
{

    public function listparticpAction()
    {
        $even = $this->getDoctrine()
            ->getRepository(Evenement::class)->findAll();
        return $this->render('@Evenement/Event/participevent.html.twig', array('even' => $even));
    }

    public function listcatfronAction()
    {
        $cat = $this->getDoctrine()
            ->getRepository(Categorie::class)->findAll();
        return $this->render('@Evenement/Event/listcatfron.html.twig', array('cat' => $cat));

        return $this->redirectToRoute("Participer");




    }
}