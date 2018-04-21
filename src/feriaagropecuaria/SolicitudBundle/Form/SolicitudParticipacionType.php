<?php

namespace feriaagropecuaria\SolicitudBundle\Form;

use feriaagropecuaria\SolicitudBundle\Entity\Credencial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SolicitudParticipacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('TipoVisitante', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\TipoVisitante',
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('NombreFirma','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Direccion','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Pais', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\Pais',
                'attr' => array(
                    'class' => 'form-control',
                    'data-attr'=> 'org'
                )))
            ->add('Organismo', 'entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\Organismo',
                'empty_value' => 'Seleccione un Organismo',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('CodigoPostal','integer', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Telefono','integer', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Fax','integer', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('email','email', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Area','entity', array(
                'class' => 'feriaagropecuaria\BackendBundle\Entity\Area',
                'attr' => array(
                    'class' => 'form-control'
                )))

            ->add('Metros','integer', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Rotulo','text', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Productos','textarea', array(
                'attr' => array(
                    'class' => 'form-control campos',
                    'style'=>'height:170px;'
                )))
            ->add('Firmas','textarea', array(
                'attr' => array(
                    'class' => 'form-control campos',
                    'style'=>'height:170px;'
                )))
            ->add('Observaciones','textarea', array(
                'attr' => array(
                    'class' => 'form-control campos',
                    'style'=>'height:170px;'
                )))

            ->add('solicitudproductos', 'collection', array(
                'type' => new SolicitudProductoType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
            ->add('Credenciales', 'collection', array(
                'type' => new CredencialType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false
            ))
            ->add('CodigoContrato', 'number', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Sala', 'number', array(
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('Stan', 'number', array(
                'attr' => array(
                    'class' => 'form-control'
                )))





        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\SolicitudBundle\Entity\SolicitudParticipacion',
            'attr'=>array('class'=>'form-horizontal')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'feriaagropecuaria_solicitudbundle_solicitudparticipacion';
    }
}
