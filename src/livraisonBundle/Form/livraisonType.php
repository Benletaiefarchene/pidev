<?php

namespace livraisonBundle\Form;
use livraisonBundle\Entity\transporteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class livraisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('datelivraison')
            ->add('lieu',ChoiceType::class,array('choices'=>['Tunis'=>'Tunis','Ariana'=>'Ariana','Gafsa'=>'Gafsa','Nabeul'=>'Nabeul','Bizerte'=>'Bizerte','Beja'=>'Beja','Jendouba'=>'Jendouba',
                'Manubah'=>'Manubah','Ben Arous'=>'Ben Arous','Zaghouan'=>'Zaghouan','Siliana'=>'Siliana','Le Kef'=>'Le Kef','Sousse'=>'Sousse','Kairouan'=>'Kairouan',
                'Kasserine'=>'Kasserine','Monastir'=>'Monastir','Mahdia'=>'Mahdia','Sidi Bou Zid'=>'Sidi Bou Zid','Sfax'=>'Sfax','Gabes'=>'Gabes','Kebli'=>'Kebli',
                'Tozeur'=>'Tozeur','Medenine'=>'Medenine','Tataouine'=>'Tataouine'],'expanded'=>false,'multiple'=>false))

            ->add('adresse')
          ->add('transporteur',EntityType::class,array('class'=>'livraisonBundle:transporteur','choice_label'=>'nom'));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'livraisonBundle\Entity\livraison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'livraisonbundle_livraison';
    }


}
