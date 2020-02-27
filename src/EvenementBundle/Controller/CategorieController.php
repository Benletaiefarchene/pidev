<?php


namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Categorie;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\CategorieType;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends  Controller
{

    public function addcatAction(Request $request)
    {

        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class, $cat);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute("catlist");
        }
        return $this->render('@Evenement/Event/addcat.html.twig', array(
            "Form" => $form->createView()
        ));
    }

    public function listAction()
    {
        $cat = $this->getDoctrine()
            ->getRepository(Categorie::class)->findAll();
        return $this->render('@Evenement/Event/catlist.html.twig', array('cat' => $cat));
    }

    public function supprimcatAction($id_categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Categorie::class)->find($id_categorie);//recuperation de avis a supp

        $em->remove($cat);
        $em->flush();//supp
        return $this->redirectToRoute("catlist");
    }

    public function modifcatAction(Request $request, $id_categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Categorie::class)->find($id_categorie);
        if ($request->isMethod('POST')) {
            $cat->setIdCategorie($request->get('id_categorie'));
            $cat->setLibelle($request->get('libelle'));

            $em->flush();
            return $this->redirectToRoute("catlist");
        }
        return $this->render('@Evenement/Event/updatecat.html.twig', array('cat' => $cat));
    }
}