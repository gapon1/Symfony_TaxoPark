<?php

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use AppBundle\Entity\Orders;
use AppBundle\Entity\User;
use AppBundle\Repository\CarRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderFormType extends AbstractType
{

    public function getUserId(UserInterface $user)
    {
        $userEmail = $user->getUsername();

        return $userEmail;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('fromAddress')
            ->add('toAddress')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('status', HiddenType::class, [
                'data' => 'waiting'
            ])
            ->add('userOrder', EntityType::class, [
                'label' => 'Your Email',
                'class' => User::class,
                'query_builder' => function(UserRepository $repository){
                return $repository->getUserId();
                }
            ])



            ->add('car', EntityType::class, [
                'placeholder' => 'Choose a Car',
                'class' => Car::class,
                'query_builder' => function(CarRepository $repository){
                return $repository->getCar();
                }
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Orders'
        ]);
    }

}
