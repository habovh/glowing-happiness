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


        $builder->add('username', null, array('label' => "Nom d'utilisateur", 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'Adresse E-Mail', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle' , 'label_attr'=> array ('class' => '')),
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation du mot de passe'),
                'invalid_message' => 'fos_user.password.mismatch' ));

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