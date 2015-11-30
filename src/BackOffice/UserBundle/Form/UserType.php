<?php

namespace BackOffice\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text', array('label' => 'Nom d\'utilisateur'))
//            ->add('usernameCanonical')
            ->add('email','email', array('label' => 'E-mail'))
//            ->add('emailCanonical')
//            ->add('enabled')
//            ->add('salt')
            ->add('password','password', array('label' => 'Mot de passe'))
//            ->add('lastLogin')
//            ->add('locked')
//            ->add('expired')
//            ->add('expiresAt')
//            ->add('confirmationToken')
//            ->add('passwordRequestedAt')
//            ->add('roles')
//            ->add('credentialsExpired')
//            ->add('credentialsExpireAt')
            ->add('groups','document',array('class'=>'BackOfficeUserBundle:Group'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOffice\UserBundle\Document\User'
        ));
    }

    public function getName()
    {
        return 'backoffice_userbundle_usertype';
    }
}
