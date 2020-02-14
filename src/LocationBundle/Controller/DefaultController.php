<?php

namespace LocationBundle\Controller;

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
}
