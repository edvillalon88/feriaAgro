<?php

namespace feriaagropecuaria\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre','text',array('attr'=>array('class'=>'form-control')))
            ->add('Descripcion','textarea',array('attr'=>array('class'=>'form-control')))
            ->add('Precio','money',array('attr'=>array('class'=>'form-control')))
            ->add('Fichero','file',array('label'=>'Foto','required'=>false,'attr'=>array('class'=>'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\BackendBundle\Entity\Servicio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feriaagropecuaria_backendbundle_servicio';
    }
}
