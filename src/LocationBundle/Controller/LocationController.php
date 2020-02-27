<?php

namespace LocationBundle\Controller;

use LocationBundle\Entity\Location;
use LocationBundle\Entity\Produit;
use LocationBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;


class LocationController extends Controller
{


    public function addLocationAction(Request $request , $id)

    {
        //$rep = $this->getDoctrine()->getManager()->getRepository(region::class);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $user->getId();
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($id);
        $produit->getId();

        $reg = new Location();
        $form = $this->createForm( LocationType::class,$reg);


        $form =$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $reg->setIdClient($user);
            $reg->setIdProduit($produit);

            $delai =date_diff($reg->getEndL(),$reg->getStartL());
           $years =$delai->y;
           $months =$delai->m;
           $jours =$delai->d;
           $heures =$delai->h;
            $time_h = ($years*8760)+($months*730.5)+($jours*24)+$heures;
            $reg->getIdProduit()->setDisponible(0);
            $a =$reg->getIdProduit()->getPrixHeure();
            $reg->setMontant(  $a * $time_h);

            $em->persist($reg);
            $em->flush();
            return $this->redirectToRoute('location_lecture',array('id'=> $reg->getIdLoc()));


        }else {
            return $this->render('@Location/Default/addlocation.html.twig', array('form' => $form->createView()));
        }

// return $this->render('@Amendes/Default/index.html.twig');
    }
    public function updateLocationAction(Request $request,$id)
    {

        $Formation = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Location::class)->find($id);
        $form =$this->createForm(LocationType::class,$Formation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($Formation);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Location_list');
        } else {
            return $this->render('@Location/Default/addlocation.html.twig', array('form' => $form->createView()));
        }

    }
    public function deleteLocationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository(\LocationBundle\Entity\Location::class)->find($id);
        $list->getIdProduit()->setDisponible(1);
        $em->remove($list);
        $em->flush();

        return $this->redirectToRoute("Location_list");

    }
    public function listLocationAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Location::class);
        $list = $em->findAll();
        return $this->render('@Location/Default/consulterlocation.html.twig', array('list' => $list));
    }

    public function lectureLocationAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Location::class);
        $list = $em->find($id);
        return $this->render('@Location/Default/loclist.html.twig', array('list' => $list));
    }
}
