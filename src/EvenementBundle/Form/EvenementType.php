<?php

namespace EvenementBundle\Form;

use EvenementBundle\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEvenement',TextType::class,[
                'label' =>  'Nom Evenement',
                'attr'  => [
                    'class' => 'form-control',
                ]
            ])
            ->add('typeEvenement',TextType::class,[
                'label' =>  'Type Evenement',
                'attr'  => [
                    'class' => 'form-control',
                ]
            ])
            ->add('lieuEvenement',TextType::class,[
                'label' =>  'Lieu Evenement',
                'attr'  => [
                    'class' => 'form-control',
                ]
            ])
            ->add('description',TextareaType::class,[
                'label' =>  'Description',
                'attr'  => [
                    'class' => 'form-control',
                ]
            ])
            ->add('dateEvenement', DateType::class,[
                'label' =>  'Date evenement',
                'format' => 'dd/MM/yyyy',
                'attr'  => [
                    'class' => 'form-control',
                ]
            ])
            ->add('categorie',EntityType::class ,array(
                'class'=>Categorie::class,
                'choice_label'=> function($entity){
                    return $entity->getLibelle();
                },
                'multiple'  =>  false,
                'expanded'  =>  false,
                'required'  =>  true,
                'label'     =>  'Categorie',
                'attr'      =>  array(
                    'class' =>  'form-control select2'
                )
            ,
            ))
        ->add('Submit',SubmitType::class,[
            'label' =>  'Ajouter'
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evenementbundle_evenement';
    }


}
