<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\Brewery;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email');
        $builder->add('roles', ChoiceType::class, [
            'label' => 'Roles',
            'mapped' => true,
            'expanded' => true,
            'multiple' => true,
            'choices' => [
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_USER' => 'ROLE_USER',
            ]]
        );
        $builder->add('plainPassword', RepeatedType::class, [
            'required' => false,
            'type' => PasswordType::class,
            'first_options'  => ['label' => 'Password'],
            'second_options' => ['label' => 'Repeat Password'],
        ]);

        $builder->add('brewery', EntityType::class, [
            'required' => false,
            'class' => Brewery::class,
            'multiple' => true
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
