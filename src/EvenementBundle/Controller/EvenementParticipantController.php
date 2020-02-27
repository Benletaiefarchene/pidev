<?php


namespace EvenementBundle\Controller;


use BaseBundle\Entity\ListP;
use BaseBundle\Entity\Utilisateur;
use ClassesWithParents\E;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use EvenementBundle\Entity\Categorie;
use EvenementBundle\Entity\Evenement;
use AppBundle\Entity\User;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementParticipantController extends Controller
{

    public function listparticpAction()
    {
        $even = $this->getDoctrine()
            ->getRepository(Evenement::class)->findAll();

        return $this->render('@Evenement/Event/participevent.html.twig', array('events' => $even));
    }

    public function listcatfronAction()
    {
        $cat = $this->getDoctrine()
            ->getRepository(Categorie::class)->findAll();
        return $this->render('@Evenement/Event/listcatfron.html.twig', array('cat' => $cat));

    }
    public function participateAction(Evenement $evenement)
    {
        $evenement->addParticipants($this->getUser());
        $user   =   $this->getUser();
        $user->addEvenements($evenement);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute("Participer");
    }
    public function annulParticipateAction(Evenement $evenement)
    {
        $evenement->removeParticipants($this->getUser());
        $user   =   $this->getUser();
        $user->removeEvenements($evenement);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute("Participer");
    }

    public function intrestAction(Evenement $evenement)
    {
        $evenement->addInteresses($this->getUser());
        $user   =   $this->getUser();
        $user->addEvenementsInteresse($evenement);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute("Participer");
    }
    public function annulIntrestAction(Evenement $evenement)
    {
        $evenement->removeInteresses($this->getUser());
        $user   =   $this->getUser();
        $user->removeEvenementsInteresse($evenement);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute("Participer");
    }

    public function showEventAction(Evenement $evenement)
    {
        return $this->render('@Evenement/Event/event_show.html.twig', [
            'event' => $evenement,
        ]);
    }

    public function searchAction(Request $request)
    {

        $categories     = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('@Evenement/Event/search.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function searchResultAction(Request $request)
    {
        $em                         = $this ->getDoctrine();
        $evenements                 = $em   ->getRepository(Evenement::class)
                                            ->findAll();
        $evenementsResults          = array();
        $evenementsNom              = array();
        $evenementsNomAndType       = array();
        $evenementsType             = array();
        $evenementsCategorie        = array();
        $evenementsLieu             = array();
        $evenementsCategorieAndLieu = array();
        $categorieSearch            = $request->get('categories');
        $nomSearch                  = $request->get('nom');
        $typeSearch                 =   $request->get('type');
        $lieuSearch                 =   $request->get('lieu');
        if($nomSearch!=null)
        {
            foreach ($evenements as $evenement)
            {
                if(strpos(strtoupper($evenement->getNomEvenement()) , strtoupper($nomSearch))!== false )
                {
                    $evenementsNom[]  =   $evenement;
                }
            }
        }
        if($lieuSearch!=null)
        {
            foreach ($evenements as $evenement)
            {
                if(strpos(strtoupper($evenement->getLieuEvenement()) , strtoupper($lieuSearch))!== false )
                {
                    $evenementsLieu[]  =   $evenement;
                }
            }
        }
        if($typeSearch!=null)
        {
            foreach ($evenements as $evenement)
            {
                if(strpos(strtoupper($evenement->getTypeEvenement()) , strtoupper($typeSearch))!== false )
                {
                    $evenementsType[]  =   $evenement;
                }
            }
        }
        if($categorieSearch!=null)
        {
            foreach($categorieSearch as $categorie)
            {
                foreach($evenements as $evenement)
                {
                    if(strtoupper($evenement->getCategorie()->getLibelle()) ==  strtoupper($categorie))
                    {
                        $evenementsCategorie[]  =   $evenement;
                    }
                }
            }
        }
        if($evenementsNom ==  null)
        {
            $evenementsNomAndType     =   $evenementsType;
        }
        elseif($evenementsType ==  null)
        {
            $evenementsNomAndType     =   $evenementsNom;
        }
        elseif($evenementsNom !=  null AND $evenementsType !=  null)
        {
            foreach($evenementsNom as $evenementNom)
            {
                $exist=false;

                foreach($evenementsType as $evenementType)
                {
                    if($evenementNom->getIdEvenement()   ==  $evenementType->getIdEvenement())
                    {
                        $exist=true;
                    }
                }

                if($exist==true)
                {
                    $evenementsNomAndType[]=$evenementNom;
                }
            }
        }
        if($evenementsCategorie ==  null)
        {
            $evenementsCategorieAndLieu     =   $evenementsLieu;
        }
        elseif($evenementsLieu ==  null)
        {
            $evenementsCategorieAndLieu     =   $evenementsCategorie;
        }
        elseif($evenementsCategorie !=  null AND $evenementsType !=  null)
        {
            foreach($evenementsCategorie as $evenementCategorie)
            {
                $exist=false;
                foreach($evenementsLieu as $evenementLieu)
                {
                    if($evenementCategorie->getIdEvenement()   ==  $evenementLieu->getIdEvenement())
                    {
                        $exist=true;
                    }
                }
                if($exist==true)
                {
                    $evenementCategorieAndLieu[] = $evenementCategorie;
                }
            }
        }
        if($evenementsCategorieAndLieu ==  null)
        {
            $evenementsResults     =   $evenementsNomAndType;
        }
        elseif($evenementsNomAndType ==  null)
        {
            $evenementsResults     =   $evenementsCategorieAndLieu;
        }
        elseif($evenementsCategorieAndLieu !=  null AND $evenementsNomAndType !=  null)
        {
            foreach($evenementsNomAndType as $evenementNomAndType)
            {
                $exist=false;
                foreach ($evenementsCategorieAndLieu as $evenementCategorieAndLieu)
                {
                    if($evenementNomAndType->getIdEvenement()   ==  $evenementCategorieAndLieu->getIdEvenement())
                    {
                        $exist=true;
                    }
                }
                if($exist==true)
                {
                    $evenementsResults[] = $evenementNomAndType;
                }
            }

        }
        return $this->render('@Evenement/Event/search_result.html.twig',[
            'events'        =>  $evenementsResults,
            'nom'           =>  $nomSearch,
            'type'          =>  $typeSearch,
            'lieu'          =>  $lieuSearch,
            'categories'    =>  $categorieSearch,
        ]);
    }
    public function graphAction()
    {
        $pieChart = new PieChart();
        $evenements = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        $data[]=['Nom du evenement','nombre participants'];
        foreach ($evenements as $evenement)
        {
            $data[]=[$evenement->getNomEvenement(),sizeof($evenement->getParticipants())];
        }
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Nombre des participants');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Evenement/Event/piechart.html.twig', array('piechart' => $pieChart));
    }
}