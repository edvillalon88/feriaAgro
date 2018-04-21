<?php

namespace feriaagropecuaria\SolicitudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CredencialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('Nombre', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Ci','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Pais', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\Pais',
                'attr' => array(
                    'class' => 'form-control col-md-3'
                )))
            ->add('Cargo','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\SolicitudBundle\Entity\Credencial'
        ));
    }

    public function getName()
    {
        return 'feriaagropecuaria_solicitud_bundle_credencial_type';
    }
}
