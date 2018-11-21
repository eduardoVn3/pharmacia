<?php

namespace PacienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PacienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,['label'=>'Nombre'])
        ->add('lastName',TextType::class,['label'=>'Apellido'])
        ->add('age',null,['label'=>'Años'])
        ->add('idNumber',TextType::class,['label'=>'Numero de telefono'])
        ->add('idType',ChoiceType::class,[
            'choices'=>[
                'DNI'=>'DNI',
                'PASAPORTE'=>'PASAPORTE'
            ],
            'label'=>'Tipo de documentacion'
        ])
        ->add('observation',TextareaType::class)
        ->add('analisi',null,['label'=>'Seleccionar un Analisis']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PacienteBundle\Entity\Paciente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pacientebundle_paciente';
    }


}
