<?php

namespace LocationBundle\Controller;

use LocationBundle\Entity\Location;
use LocationBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class LocationController extends Controller
{


    public function addLocationAction(Request $request)

    {
        //$rep = $this->getDoctrine()->getManager()->getRepository(region::class);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $user->getId();

        $reg = new Location();
        $form = $this->createForm( LocationType::class,$reg);
        $form =$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $reg->setIdClient($user);
            $em->persist($reg);
            $em->flush();
            return $this->redirectToRoute('Location_list');


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
}
