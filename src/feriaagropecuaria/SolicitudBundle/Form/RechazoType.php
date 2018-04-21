<?php

namespace feriaagropecuaria\SolicitudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechazoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('Descripcion', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\SolicitudBundle\Entity\Rechazo'
        ));
    }

    public function getName()
    {
        return 'feriaagropecuaria_solicitud_bundle_rechazo_type';
    }
}
