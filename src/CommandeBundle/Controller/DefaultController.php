<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\cmd;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CommandeBundle:Default:index.html.twig');
    }

    public function convertAction(Request $request, cmd $cmd)
    {
        $snappy = $this->get("knp_snappy.pdf");

        $html = $this->renderView("@Commande/Commande/commandePdf.html.twig", array(
            "title" => "Awesome PDF Title",
            'cmd'=>$cmd
        ));

        $filename = "resultat";

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
            )
        );

    }
}
