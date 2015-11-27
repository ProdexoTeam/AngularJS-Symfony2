<?php

namespace BackOffice\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
    
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackOffice\UserBundle\Document\Group',
            'roles' => null
        ));
    }

    public function getName() {
        return 'backoffice_userbundle_grouptype';
    }

    private function refactorRoles($originRoles) {
        $roles = array();
        $rolesAdded = array();

        // Add herited roles
        foreach ($originRoles as $roleParent => $rolesHerit) {
            $tmpRoles = array_values($rolesHerit);
            $rolesAdded = array_merge($rolesAdded, $tmpRoles);
            $roles[$roleParent] = array_combine($tmpRoles, $tmpRoles);
        }
        // Add missing superparent roles
        $rolesParent = array_keys($originRoles);
        foreach ($rolesParent as $roleParent) {
            if (!in_array($roleParent, $rolesAdded)) {
                $roles['-----'][$roleParent] = $roleParent;
            }
        }

        return $roles;
    }

}
