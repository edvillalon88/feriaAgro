<?php

namespace feriaagropecuaria\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Fichero', 'file', array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Descripcion', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Fecha', 'date', array(
                'widget' => 'single_text'
            ))
            ->add('Album', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\Album',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\BackendBundle\Entity\Foto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feriaagropecuaria_backendbundle_foto';
    }
}
