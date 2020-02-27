<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\cmd;
use Dompdf\Dompdf;
use Dompdf\Options;
use CommandeBundle\Form\cmdType;
use MongoDB\Driver\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class gestioncmdController extends Controller
{
    public function ajoutCmdClientAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $cmd = new cmd();
        $form = $this->createForm(cmdType::class,$cmd);
        $form->handleRequest($request);

        $user = $this->container->get('security.token_storage')->getToken()->getuser();

        $ligne = $user->getLignecmds();
        $prix =0 ;
          foreach ($ligne as $l) {
              if ($l->getEtat() == 0) {
                  $prix = ($l->getProduit()->getPrix() * $l->getQuantite()) + $prix;
                  $l->setEtat(1);
                  $l->getProduit()->setQte($l->getProduit()->getQte()-$l->getQuantite());

              }
        }

        if($form->isSubmitted())
        {
            $user = $this->container->get('security.token_storage')->getToken()->getuser();
            $user->getId();
            $cmd->setPrix($prix);
            $cmd->setUserid($user);
            $em->persist($cmd);
            $em->flush();
            return $this->redirectToRoute('commande_affiche_Client', array('id'=>$cmd->getId()));
        }

        return $this->render("@Commande/Commande/ajoutC.html.twig",array("form"=>$form->createView(),"prix"=>$prix));
    }

    public function afficheCmdAdminAction()
    {
        $em=$this->getDoctrine()->getManager();
        $cmd=$em->getRepository("CommandeBundle:cmd")->findAll();

        return $this->render("@Commande/Commande/afficheC.html.twig",array("cmd"=>$cmd));
    }

    public function afficheCmdClientAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $cmd=$em->getRepository('CommandeBundle:cmd')->find($id);
        return $this->render('@Commande/Commande/afficheCmdC.html.twig',array('cmd'=>$cmd));



    }
    public function supprimerCmdAdminAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $cmd = $em->getRepository(cmd::class)->find($id);
        $em->remove($cmd);
        $em->flush();
        return $this->redirectToRoute('commande_affiche_admin');
    }


    public function pdfAction($id,Request $request)
    {

        $pdfOptions= new Options();
        $pdfOptions->set('defaultFont','Arial');
        $dompdf = new Dompdf($pdfOptions);
        $em=$this->getDoctrine()->getManager();
        $liste=$em->getRepository(cmd::class)->find($id);
        $html= $this->renderView('@Commande/Commande/pdf.html.twig', array(
            "cmd"=>$liste
        ));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $output=$dompdf->output();

        $path='E:/pi/Commande.pdf';
        $pdfFilePath=$path;
        file_put_contents($pdfFilePath,$output);
        return $this->redirectToRoute("produit_afficheProduitsClient");

    }
}
