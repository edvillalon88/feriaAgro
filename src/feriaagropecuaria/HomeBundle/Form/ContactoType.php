<?php

namespace feriaagropecuaria\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Nombre','text',array('attr'=>array('placeholder'=>'Nombre completo')))
                ->add('Telefono','number',array('required'=>false, 'attr'=>array('placeholder'=>'+53 5 1234567')))
                ->add('Email','email',array('attr'=>array('placeholder'=>'usuari@servidor.com')))
                ->add('Texto','textarea',array('attr'=>array('style'=>'height:170px;')))
                ->add('Pais','entity',array(
                    'class' => 'feriaagropecuaria\BackendBundle\Entity\Pais'
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\HomeBundle\Entity\Contacto'
        ));
    }

    public function getName()
    {
        return 'feriaagropecuaria_solicitud_bundle_contacto_type';
    }
}
