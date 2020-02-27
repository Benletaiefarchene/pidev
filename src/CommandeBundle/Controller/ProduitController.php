<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\Categorie;
use CommandeBundle\Entity\lignecmd;
use CommandeBundle\Entity\Produit;
use CommandeBundle\Form\ProduitType;
use Endroid\QrCode\QrCode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

class ProduitController extends Controller
{
    public function afficheProduitsAction()
    {
        $produits=$this->getDoctrine()->getManager()->getRepository('CommandeBundle:Produit')->findAll();
        return $this->render('@Commande\Default\afficherproduits.html.twig',array('produits'=>$produits));
    }

    public function supprimerProduitAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $lignecmd = $em->getRepository(Produit::class)->find($id);
        $em->remove($lignecmd);
        $em->flush();
        return $this->redirectToRoute('produit_afficheProduits');
    }
    public function ajouterProduitAction(Request $request)
    {
        $produit = new Produit();
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            /** @var UploadedFile $file */
            $file = $produit->getImage();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$filename
            );
            $produit->setImage($filename);
            $normalizer = new DataUriNormalizer();//pour converttir les données
            $qrCode = new QrCode($produit->getId()."donnée à discuter avec le groupe");//genirina qr mat3na
            $qrCode->writeFile(__DIR__.'/qrcode.png');//soufrom d'u img pour sauv hatnha fi taswira
            $avatar = $normalizer->normalize(new \SplFileObject(__DIR__.'/qrcode.png'));//3atina

            $produit->setQrcode($avatar);
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_afficheProduits');
        }
        return $this->render('@Commande\Default\ajouterProduit.html.twig',array("form"=>$form->createView()));

    }


}
