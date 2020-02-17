<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array('attr'=>array(
              'class'=>"validate",
              'type'=>'text',
              'placeholder' => 'First Name'
             )))
            ->add('lname', TextType::class,array('attr'=>array(
              'class'=>"validate",
              'type'=>'text',
              'placeholder' => 'Last Name'
             )))
            ->add('email', TextType::class,array('attr'=>array(
              'class'=>"validate",
              'type'=>'text',
              'placeholder' => 'E-mail'
             )))
            ->add('username', TextType::class,array('attr'=>array(
              'class'=>"validate",
              'type'=>'text',
              'placeholder' => 'Username'
             )))
            ->add('password', PasswordType::class,array('attr'=>array(
              'class'=>"validate",
              'type'=>'password',
              'placeholder' => 'Password'
             )))
            ->add('attachment', FileType::class, [
              'mapped' => false,
              'required' => false,
             ])
            ->add('role', ChoiceType::class, [
              'choices'  => [
                'Admin' => 'ROLE_ADMIN',
                'User' => 'ROLE_USER',
             ]])
            ->add('save', SubmitType::class,array('attr'=>array(
              'class'=>"waves-effect waves-light btn indigo center x-large",
              'id' =>'send'
             )))
            ->add('department', EntityType::class, [
              'class' => Department::class
             ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => User::class,
        ]);
    }
}
