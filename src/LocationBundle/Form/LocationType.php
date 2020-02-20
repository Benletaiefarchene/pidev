<?php

namespace LocationBundle\Form;

use AppBundle\Entity\User;
use LocationBundle\Entity\Location;
use LocationBundle\Entity\Magasin;
use LocationBundle\Entity\Produit;
use LocationBundle\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$years = range(date('Y'), date('Y') + 1);
        $builder
            ->add('start_l')
            ->add('end_l')
            //->add('id_Produit',EntityType::class,['class'=>Produit::class,'choice_label'=>'refProduit','multiple'=>false]);
           // ->add('id_reg',EntityType::class,['class'=>Region::class,'choice_label'=>'nom','multiple'=>false])
            ->add('id_Produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => function (Produit $id_Produit) {
                    return  $id_Produit->getIdMagasin()->getNameM().' '.$id_Produit->getIdMagasin()-> getIdRegion()->getNom().' '. $id_Produit->getRefProduit();
                },
           ]);
          //  ->add('id_client',EntityType::class,['class'=>User::class,'choice_label'=>'id','multiple'=>false]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LocationBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'locationbundle_location';
    }


}
