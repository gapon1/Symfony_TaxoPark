<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 19:27
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('carType')
            ->add('driverId')
            ->add('carDiscript')
            ->add('carImg');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Car'
        ]);
    }
}
