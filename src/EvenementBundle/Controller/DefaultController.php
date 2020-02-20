<?php

namespace EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }
    public function ParticiperAction()
    {
        return $this->render('@Evenement/Event/ParticipeEvent.html.twig');
    }
}
