<?php

namespace CommandeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle',TextType::class,array('attr' => array('class'=>'form-control','style' => 'margin-bottom:15px')))
                ->add('qte',TextType::class,array('attr' => array('class'=>'form-control','style' => 'margin-bottom:15px')))
                ->add('prix',TextType::class,array('attr' => array('class'=>'form-control','style' => 'margin-bottom:15px')))
                ->add('categorie',EntityType::class,array(
                        'class'=>'CommandeBundle:Categorie',
                        'choice_label'=>'libelle',
                        'attr'=>array('class'=>'form-control form-control-lg','style' => 'margin-bottom:15px'),
                        'multiple'=>false))
                ->add('image',FileType::class,array('attr' => array('class'=>'btn','style' => 'margin-bottom:15px','value'=>'choisir image'),'data_class' => null))

                ->add("Ajouter",SubmitType::class,array('attr'=>array('class'=>'btn btn-primary','style'=>'width:100%;margin-bottom:15px')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CommandeBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'commandebundle_produit';
    }


}
