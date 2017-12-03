<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', TextType::class, array('label' => false))
            ->add('email', EmailType::class, array('label' => false))
            ->add('firstName', TextType::class, array('label' => false))
            ->add('surname', TextType::class, array('label' => false))
            ->add('age', IntegerType::class, array('label' => false))
            ->add('gender', ChoiceType::class, array('choices' => array(
                    'Мужской' => '0',
                    'Женский' => '1'
                ),
                'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
            ->add('phone', TextType::class, array('label' => false))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => false],
                'second_options' => ['label' => false],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
        ]);
    }
}