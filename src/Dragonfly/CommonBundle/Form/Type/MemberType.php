<?php

namespace Dragonfly\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, array(
                    'label' => 'Utilisateur',
                    'class' => 'DragonflyCommonBundle:User',
                    'choice_label' => 'username',
                    // 'required'  => false,
                    // 'expanded'  => false,
                    // 'empty_data'  => null,
                    // 'placeholder' => 'Choisir un utilisateur'
                )
            )
            ->add('role', EntityType::class, array(
                    'label' => 'Role',
                    'class' => 'DragonflyCommonBundle:Role',
                    'choice_label' => 'name',
                    // 'required'  => false,
                    // 'expanded'  => false,
                    // 'empty_data'  => null,
                    // 'placeholder' => 'Choisir un role'
                )
            );
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dragonfly\CommonBundle\Entity\Member',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'cascade_validation' => true,
        );
    }

    public function getName()
    {
        return 'dragonfly_common_member';
    }
}