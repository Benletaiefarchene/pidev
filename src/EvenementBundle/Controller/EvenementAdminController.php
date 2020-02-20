<?php


namespace EvenementBundle\Controller;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class EvenementAdminController extends Controller
{
    public function afficheeventAadminAction()
    {


        $Evenement = $this->getDoctrine()->getRepository(Evenement::class)->findBy(array('etat' => "A"));

        return $this->render('@Evenement/Event/eventadmin.html.twig', array('a' => $Evenement));
    }

    public function afficheeventDadminAction()
    {

        $Evenementd = $this->getDoctrine()->getRepository(Evenement::class)->findBy(array('etat' => "D"));
        return $this->render('@Evenement/Event/eventadminD.html.twig', array('d' => $Evenementd));
    }

    public function activerAction($Id)
    {

        $Evenement = $this->getDoctrine()->getRepository(Evenement::class)->actvevenement($Id);
        return $this->redirectToRoute('eventaffadminD');
    }

    public function desactiverAction($Id)
    {
        $Evenement = $this->getDoctrine()->getRepository(Evenement::class)->descevenement($Id);
        return $this->redirectToRoute('eventaffadmin');
    }


    public function rechercheeventAction(Request $request)
    {
        $evenement = new \EvenementBundle\Entity\Evenement();
        if ($request->isMethod('POST')) {

            $evenement->setNomEvenement($request->get('nom'));

            $en = $this->getDoctrine()->getManager();
            $evenement = $en->getRepository("EvenementBundle:Evenement")->findBy(array('nomEvenement' => $evenement->getNomEvenement()));
            return $this->render('@Event/Event/rechercheradmin.html.twig', array('e' => $evenement));

        } else {
            $enn = $this->getDoctrine()->getManager();
            $evenement = $enn->getRepository("EvenementBundle:Evenement")->findAll();

            return $this->render('@Evenement/Event/rechercheradmin.html.twig', array('e' => $evenement));
        }
    }
    public function addAction(Request $request)
    {

        $even = new Evenement();
        $form= $this->createForm(EvenementType::class, $even);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $even->setEtat('pending');
            $em = $this->getDoctrine()->getManager();


            $em->persist($even);
            $em->flush();
            return $this->redirectToRoute("eventlist");
        }
        return $this->render('@Evenement/Event/add.html.twig', array(
            "Form"=> $form->createView()
        ));
    }


    public function modifierAction(Request $request,$idEvenement)
    {
        $em=$this->getDoctrine()->getManager();
        $even=$em->getRepository(Evenement::class)->find($idEvenement);
        if($request->isMethod('POST'))
        {
            $even->setIdEvenement($request->get('idEvenement'));
            $even->setNomEvenement($request->get('nomEvenement'));
            $even->setTypeEvenement($request->get('typeEvenement'));
            $even->setLieuEvenement($request->get('lieuEvenement'));
            $even->setDescription($request->get('description'));
            $even->setNbParticipant($request->get('nbParticipant'));
            $even->setDateEvenement($request->get('dateEvenement'));
            $even->setNbInteresser($request->get('nbInteresser'));

            $em->flush();
            return $this->redirectToRoute("eventlist");
        }
        return $this->render('@Evenement/Event/update.html.twig',array('even'=>$even));
    }



    public function listAction()
    {
        $even=$this->getDoctrine()
            ->getRepository(Evenement::class)->findAll();
        return $this->render('@Evenement/Event/list.html.twig',array('even'=>$even));
    }
    public function supprimerAction($idEvenement)
    {
        $em = $this->getDoctrine()->getManager();
        $even= $em->getRepository(Evenement::class)->find($idEvenement);//recuperation de avis a supp
        $em->remove($even);
        $em->flush();//supp
        return $this->redirectToRoute("eventlist");
    }
    public function changeStatusAction(Evenement $evenement,string $etat)
    {
        $evenement->setEtat($etat);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute("eventlist");
    }

}