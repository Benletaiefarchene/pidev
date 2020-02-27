<?php
namespace LocationBundle\Controller;

use AppBundle\Entity\Notification;
use LocationBundle\Entity\Magasin;
use LocationBundle\Form\MagasinType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MagasinController extends Controller
{


public function addmagasinAction(Request $request)

{
//$rep = $this->getDoctrine()->getManager()->getRepository(region::class);
$M = new Magasin();
$form = $this->createForm( MagasinType::class,$M);
$form =$form->handleRequest($request);
if($form->isValid()){
$em=$this->getDoctrine()->getManager();
$em->persist($M);
$em->flush();


  return $this->redirectToRoute('Magasin_list');


}else {
return $this->render('@Location/Default/addmagasin.html.twig', array('form' => $form->createView()));
}

// return $this->render('@Amendes/Default/index.html.twig');
}
    public function updatemagasinAction(Request $request,$id)
    {

        $Formation = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Magasin::class)->find($id);
        $form =$this->createForm(MagasinType::class,$Formation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($Formation);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Magasin_list');
        } else {
            return $this->render('@Location/Default/addmagasin.html.twig', array('form' => $form->createView()));
        }

    }

    public function deletemagasinAction($id)
{
$em = $this->getDoctrine()->getManager();
$list = $em->getRepository(\LocationBundle\Entity\Magasin::class)->find($id);
$em->remove($list);
$em->flush();

return $this->redirectToRoute("Magasin_list");

}
public function listmagasinAction()
{
$em = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Magasin::class);
$list = $em->findAll();
return $this->render('@Location/Default/consultermagasin.html.twig', array('list' => $list));
}
}

