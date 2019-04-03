<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 19:27
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('password')
            ->add('email')
            ->add('useId')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'ADMIN' => 'ADMIN',
                    'DRIVER' => 'DRIVER',
                    'CUSTOMER' => 'CUSTOMER',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User'
        ]);
    }
}
