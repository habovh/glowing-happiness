<?php

namespace Resto\MainBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\LoginFormType as BaseType;

class LoginFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field


        $builder->add('username', null, array('label' => "Login", 'translation_domain' => 'FOSUserBundle'))
            
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle' , 'label_attr'=> array ('class' => '')),
                'first_options' => array('label' => 'Mot de passe'),
                
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