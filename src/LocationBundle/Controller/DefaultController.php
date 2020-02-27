<?php

namespace LocationBundle\Controller;

use AppBundle\Entity\Notification;
use Doctrine\ORM\Query;
use LocationBundle\Entity\Magasin;
use LocationBundle\Entity\Produit;
use LocationBundle\Entity\Region;
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
        $region = $this->getDoctrine()->getManager()->getRepository(Region::class)->findOneBy(['nom'=> $ville]);
        $m=$this->getDoctrine()->getManager()->getRepository(Magasin::class)->findBy(['id_region' =>$region->getid_reg()]);

        return $this->render('@Location/Default/magasinlist.html.twig', array(
            'list' => $m
        ));
    }
    public function notificationAction(){
        $notification = $this->getDoctrine()->getManager()->getRepository(Notification::class)->findAll();
        return $this->render('@Location/Default/a.html.twig', array(
            'notifications' => $notification
        ));
    }
    public function listproduitAction($id_magasin)
    {
        $magasin = $this->getDoctrine()->getManager()->getRepository(Magasin::class)->findOneBy(['id'=> $id_magasin]);

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT l
            FROM LocationBundle:Produit p,
            LocationBundle:Location l
            WHERE p.id = l.id_Produit
            and l.end_l < :date'
        )->setParameter('date', new \DateTime());

        $products = $query->getResult();
        //Query::HYDRATE_ARRAY
        // changer produits avec date finis en disponible
        //dump($products);
        foreach ($products as $product)
        {
            $product->getIdProduit()->setDisponible(1);
            $em ->persist($product);
            $em->flush();
            dump($product);

        }

        $a = $this->getDoctrine()->getManager();
        $query = $a->createQuery(
            'SELECT l
            FROM LocationBundle:Produit p,
            LocationBundle:Location l
            WHERE p.id = l.id_Produit
            and l.end_l > :date'
        )->setParameter('date', new \DateTime());

        $products = $query->getResult();
        //Query::HYDRATE_ARRAY
        // changer produits avec date finis en disponible
        //dump($products);
        foreach ($products as $product)
        {
            $product->getIdProduit()->setDisponible(0);
            $a ->persist($product);
            $a->flush();
            dump($product);

        }

        $m=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)
            ->findBy([
                'id_Magasin' => $magasin->getId(),
                "Disponible" => 1,
                "statut" => 1
            ]);
        return $this->render('@Location/Default/consulterproduit.html.twig', array(
            'list' => $m
        ));
    }

}

