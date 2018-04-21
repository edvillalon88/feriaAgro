<?php

namespace feriaagropecuaria\SolicitudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SolicitudProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ServicioMobiliariaProducto', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\ServicioMobiliariaProducto',
                'label'=> 'Servcios o Insumos'
            ))

            ->add('Cantidad')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\SolicitudBundle\Entity\SolicitudProducto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feriaagropecuaria_solicitudbundle_solicitudproducto';
    }
}
