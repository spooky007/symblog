<?php

namespace FutureTech\SymblogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class);
        $builder->add('email', EmailType::class);
        $builder->add('password', RepeatedType::class);
        $builder->add('submit', SubmitType::class, [
        	'att' => [
        		'class' => 'btn btn-success pull-right'
        	]
       	]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    	$resolver->setDefaults([
    		'data_class' => User::class
    	])
    }
} 