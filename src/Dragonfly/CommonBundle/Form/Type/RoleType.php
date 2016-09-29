<?php

namespace Dragonfly\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                    'label' => 'Nom',
                    'required'  => true,
                )
            );
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dragonfly\CommonBundle\Entity\Role',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'cascade_validation' => true,
        );
    }

    public function getName()
    {
        return 'dragonfly_common_role';
    }
}