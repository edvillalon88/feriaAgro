<?php

namespace feriaagropecuaria\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Usuario','text', array('attr'=>array('class'=>'form-control')))
            ->add('Password', 'repeated', array(
                'type' => 'password',
                'first_options'=> array('attr'=>array('class'=>'form-control')),
                'second_options'=> array('attr'=>array('class'=>'form-control'),'label'=>'Confirme la contraseña'),
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña')))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'feriaagropecuaria\UsuarioBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'feriaagropecuaria_usuario_bundle_usuario_type';
    }
}
