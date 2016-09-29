<?php

namespace Dragonfly\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                    'label' => 'Nom',
                    'required'  => true,
                )
            )
            ->add('workflow', EntityType::class, array(
                    'label' => 'Workflow',
                    'class' => 'DragonflyCommonBundle:Workflow',
                    'required'  => true,
                    'expanded'  => false,
                    'choice_label' => 'name',
                    'empty_data'  => null,
                    'placeholder' => 'Choisir un workflow',
                )
            )
            ->add('members', CollectionType::class, array(
                    'label' => 'Membres',
                    // 'allow_add' => true,
                    // 'allow_delete' => true,
                    //'delete_empty' => true,
                    'prototype' => true, 
                    // 'by_reference' => false,
                    'entry_type'   => MemberType::class,
                    // 'entry_options'  => array(
                    //     'label' => false
                    // ),
                )
            );
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dragonfly\CommonBundle\Entity\Project',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'cascade_validation' => true,
        );
    }

    public function getName()
    {
        return 'dragonfly_common_project';
    }
}