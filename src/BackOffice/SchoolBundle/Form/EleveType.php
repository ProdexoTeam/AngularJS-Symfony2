<?php

namespace BackOffice\SchoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EleveType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('classe', 'document', array(
                    'class' => 'BackOffice\SchoolBundle\Document\Classe',
                    'mapped' => 'false'
                ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackOffice\SchoolBundle\Document\Eleve'
        ));
    }

    public function getName() {
        return 'backoffice_schoolbundle_elevetype';
    }

}
