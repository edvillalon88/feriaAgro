<?php

namespace feriaagropecuaria\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre','text',array('attr'=>array('class'=>'form-control')))
            ->add('Fichero1','file',array('label'=>'Foto1','required'=>false,'attr'=>array('class'=>'form-control')))
            ->add('Fichero2','file',array('label'=>'Foto2','required'=>false,'attr'=>array('class'=>'form-control')))
            ->add('Fichero3','file',array('label'=>'Foto3','required'=>false,'attr'=>array('class'=>'form-control')))
            ->add('Descripcion','textarea',array('attr'=>array('class'=>'form-control')))
            ->add('Precio','money',array('attr'=>array('class'=>'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\BackendBundle\Entity\Producto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feriaagropecuaria_backendbundle_producto';
    }
}
