<?php

namespace livraisonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use livraisonBundle\Entity\livraison;
use livraisonBundle\Entity\transporteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormTypeInterface;
class transportController extends Controller
{

    public function indexAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository('livraisonBundle:Post')->findAll();
        return $this->render('@livraison/livraison/index.html.twig', array(
            "posts" =>$posts
        ));
        return $this->redirectToRoute('index_page');
    }


    public function addtAction(Request $request)
    {
        $t = new transporteur();
        $form = $this->createForm('livraisonBundle\Form\transporteurType', $t);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())  {
            $em = $this->getDoctrine()->getManager();
            $em= $this->getDoctrine()->getManager();
            $em->persist($t);
            $em->flush();
             $t->getId();
            $userManager = $this->container->get('fos_user.user_manager');

            $user = $userManager->createUser();
            $user->setUsername($t->getUsername());
            $user->setRoles(array('ROLE_LIVREUR'));
            $user->setEmail($t->getEmail());
            $user->setPlainPassword($t->getPassword());
            $user->setEnabled(true);
            $user->setIdtrans($t->getId());
            $userManager->updateUser($user);

            return $this->redirectToRoute("ConsulterTransporteur");
        }
        return $this->render('@livraison/transporteur/addtransp.html.twig', array('form'=> $form->createView()));
    }
    public function readtAction()
    {
        $t=$this->getDoctrine()->getRepository(transporteur::class)->findAll();
        return $this->render('@livraison/transporteur/readtransp.html.twig',array('transp'=>$t));
    }

    public function deletetAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $transp= $em->getRepository(transporteur::class)->find($id);//recuperation de avis a supp
        $transp->getLivraison();
        $em->remove($transp);
        $em->flush();//supp
        return $this->redirectToRoute("ConsulterTransporteur");
    }



    public function updatetAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $transp=$em->getRepository(transporteur::class)->find($id);
        if($request->isMethod('POST'))
        {
            $transp->setNom($request->get('nom'));
            $transp->setPrenom($request->get('prenom'));
            $transp->setTel($request->get('tel'));
            $transp->setEmail($request->get('email'));


            $em->flush();
            return $this->redirectToRoute("ConsulterTransporteur");
        }
        return $this->render('@livraison/transporteur/updatetransp.html.twig',array('transp'=>$transp));
    }


   /** public function updatetAction(Request $request, $id)
    {
        $transporteur=new transporteur();
        $deleteForm = $this->createDeleteForm($transporteur);
        $editForm = $this->createForm('livraisonBundle\Form\transporteurType', $transporteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ModifierTransporteur', array('idTransp' => $transporteur->getId()));
        }

        return $this->render('transporteur/updatetransp.html.twig', array(
            'transporteur' => $transporteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    private function createDeleteForm(transporteur $transporteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('SupprimerTransporteur', array('idTransp' => $transporteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    **/
public function afficheAction(){
    $user = $this->getUser();
    $trans =  $this->getDoctrine()->getRepository(transporteur::class)->findOneById($user->getIdtrans());

    $livraison= $trans->getLivraison();
    $livraison =  $this->getDoctrine()->getRepository(livraison::class)->findBy(['etatlivraison' => 0]);
    return $this->render("@livraison/transporteur/affichelivraison.html.twig",
        array ('livraison'=>$livraison,'id'=>$user->getIdtrans()));
}
    public function delete2Action(Request $request)
    {   $em= $this->getDoctrine()->getManager();
        $idt = $request->get('idt');
        $trans =  $this->getDoctrine()->getRepository(transporteur::class)->findOneById($idt);

        $trans->setCapacite($trans->getCapacite()-1);

        $em->persist($trans);
        $em->flush();
        $id = $request->get('id');

        $livraison=$em->getRepository('livraisonBundle:livraison')->find($id);
        $livraison->setEtatlivraison(1);
        $em->persist($livraison);
        $em->flush();
        return $this->redirectToRoute('affichelivraison');
    }


}