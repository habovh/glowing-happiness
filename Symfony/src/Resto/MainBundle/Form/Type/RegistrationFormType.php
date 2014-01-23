<?php

namespace Resto\MainBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('nom');
        $builder->add('adresse');
        $builder->add('tel');

        //...............
        //Add all your properties here with $builder->add('property name')
    }

    public function getName()
    {
        return 'resto_user_registration';
    }
}