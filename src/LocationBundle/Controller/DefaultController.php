<?php

namespace LocationBundle\Controller;

use LocationBundle\Entity\Magasin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function homeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository('LocationBundle:Location')->findAll();
        return $this->render('@Location/Default/home.html.twig', array(
            "posts" =>$posts
        ));
        return $this->redirectToRoute('home_page');
    }

    public function mapAction(){

        return $this->render('@Location/Default/map.html.twig');
    }
    public function villeAction($ville)
    {
        $m=$this->getDoctrine()->getRepository(Magasin::class)->findBy(array('id_region' =>$ville));

        return $this->render('@Location/Default/consultermagasin.html.twig', array(
            'list' => $m
        ));
    }
}
