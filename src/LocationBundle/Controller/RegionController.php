<?php

namespace LocationBundle\Controller;

use LocationBundle\Entity\Region;
use LocationBundle\Form\regionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class RegionController extends Controller
{


    public function addAction(Request $request)

    {
        //$rep = $this->getDoctrine()->getManager()->getRepository(region::class);
        $reg = new Region();
        $form = $this->createForm( regionType::class,$reg);
        $form =$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($reg);
            $em->flush();
        return $this->redirectToRoute('region_list');


        }else {
            return $this->render('@Location/Default/addregion.html.twig', array('form' => $form->createView()));
        }

// return $this->render('@Amendes/Default/index.html.twig');
    }
    public function updateAction(Request $request,$id)
    {

        $Formation = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Region::class)->find($id);
        $form =$this->createForm(regionType::class,$Formation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($Formation);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('region_list');
        } else {
            return $this->render('@Location/Default/addregion.html.twig', array('form' => $form->createView()));
        }

    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository(\LocationBundle\Entity\Region::class)->find($id);
        $em->remove($list);
        $em->flush();

        return $this->redirectToRoute("region_list");

    }
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Region::class);
        $list = $em->findAll();
        return $this->render('@Location/Default/consulterregion.html.twig', array('list' => $list));
    }
}
