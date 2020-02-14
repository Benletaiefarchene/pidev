<?php

namespace livraisonBundle\Controller;

use http\Env\Request;
use livraisonBundle\Entity\livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render("@livraison/livraison/index.html.twig");
    }


}
