<?php

namespace livraisonBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use livraisonBundle\Entity\livraison;
use livraisonBundle\Entity\transporteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if (!empty($user->getIdtrans())) {
            $user = $this->getUser();
            $trans =  $this->getDoctrine()->getRepository(transporteur::class)->findOneById($user->getIdtrans());

            $livraison= $trans->getLivraison();
            $livraison =  $this->getDoctrine()->getRepository(livraison::class)->findBy(['etatlivraison' => 0]);
            return $this->render("@livraison/transporteur/affichelivraison.html.twig",
                array ('livraison'=>$livraison,'id'=>$user->getIdtrans()));
        }
        else {
            if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')
            ) {

                return $this->render("base.html.twig");

            }
            else {
                if ($this->container->get('security.authorization_checker')->isGranted('ROLE_RESPEV')
                ) {
                    return $this->render("base.html.twig");

            }}
        return $this->render("index.html.twig"); }
    }
    public function affecterAction(Request $request,$id)
    {
        $liv = $this->getDoctrine()-> getRepository(livraison::class)->find($id);
        $form = $this->createForm('livraisonBundle\Form\livraisonType', $liv);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())  {

            $em = $this->getDoctrine()->getManager();
            $task = $form->getData();
          $t =  $task->getTransporteur();
           $liv->setTransporteur($t);
           $em->persist($liv);
           $em->flush();
            $tr=$em->getRepository('livraisonBundle:livraison')->find(($this->getTransporteur()->getId()));
            $tr->setCapacite(($tr->getCapacite())+1);
            $em->flush();
            if(($tr->getCapacite())>20){
                $tr->setDispo(0);
                $em->flush();
            }
            return $this->redirectToRoute("map");
        }
        return $this->render("@livraison/livraison/addtransporteur.html.twig", array(
            'form'=> $form->createView()
        ));
    }

    public function newAction(Request $request)
    {
        $livraison = new livraison();
        $livraison->setEtatlivraison(0);
        $form= $this->createForm('livraisonBundle\Form\livraisonType', $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livraison);
            $em->flush();

            return $this->redirectToRoute('ConsulterLivraison', array('id' => $livraison->getId()));
        }

        return $this->render('@livraison/livraison/add.html.twig', array(
            'livraison' => $livraison,
            "form" => $form->createView()));
    }


    public function readAction( )
    {
        $livraison= $this->getDoctrine()-> getRepository(livraison::class)->findAll();
        return $this->render("@livraison/livraison/consulterLivraison.html.twig",array ('livraison'=>$livraison));
    }


    public function deleteAction(Request $request)
    {
        $idt = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $livraison= $em->getRepository(livraison::class)->find($idt);//recuperation de avis a supp
        $em->remove($livraison);
        $em->flush();//supp
        return $this->redirectToRoute("ConsulterLivraison");
    }






    public function mapAction(){

        return $this->render('@livraison/livraison/map.html.twig');
    }
    /**
     * Finds and displays a livraison entity.
     *
     */
    public function villeAction($ville)
    {
        $v=$this->getDoctrine()->getRepository(livraison::class)->findBy(array('lieu'=>$ville));
        return $this->render('@livraison/livraison/showliv.html.twig', array(
            'livraison' => $v
        ));
    }
public function statregionAction(){

    $data = [
        ['Ariana',COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Ariana')))],
        ['Ben Arous', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Ben Arous')))],
        ['Bizerte', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Bizerte')))],
        ['Gabes', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Gabes')))],
        ['Kairouan', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Kairouan')))],
        ['Mahdia', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Mahdia')))],
        ['Manouba', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Manouba')))],
        ['Tunis', COUNT($this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Tunis')))],
        ['Sfax', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Sfax')))],
        ['Siliana', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Siliana')))],
        ['Sousse', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Sousse')))],
        ['Tunis', COUNT( $this->getDoctrine()-> getRepository(livraison::class)->findBy(array('lieu'=>'Tunis')))],

    ];

    $ob = new Highchart();
    $ob->chart->renderTo('container');
    $ob->chart->type('pie');
    $ob->title->text('My Pie Chart');
    $ob->series(array(array("data"=>$data)));

    return $this->render('@livraison\livraison\statregion.html.twig', [
        'mypiechart' => $ob
    ]);
}
}
