<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\lignecmd;
use CommandeBundle\Form\lignecmdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitClientController extends Controller
{
    public function afficheProduitsClientAction()
    {
        $produits=$this->getDoctrine()->getManager()->getRepository('CommandeBundle:Produit')->getProduitbyPrix();
        return $this->render('@Commande/Default/clientViews/afficheProduitsClient.html.twig',array('produits'=>$produits));
    }

    public function detailsProduitClientAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('CommandeBundle:Produit')->find($id);


        $a=$this->getDoctrine()->getManager();
        $lignecmd = new lignecmd();
        $form = $this->createForm(lignecmdType::class,$lignecmd);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $task = $form->getData();

            if ($task->getQuantite() > $produit->getQte()) {

                return $this->render('@Commande/Ligne/Quantite.html.twig');
        }
            else {
                $lignecmd->setEtat(0);
                $lignecmd->setProduit($produit);
                $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $user->getId();
                $lignecmd->setUserid($user);
                $a->persist($lignecmd);
                $a->flush();
            }
        }

        return $this->render('@Commande/Default/clientViews/detailsProduitClient.html.twig',array(
            'produit'=>$produit,
            'form' => $form->createView()
            ));
    }




}
