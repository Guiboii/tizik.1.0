<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\School;
use App\Form\ApplicationType;
use App\Repository\RoleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('userName', TextType::class, $this->getConfiguration("Nom d'utilisateur", "Votre pseudo..."))
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom de famille..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('picture', UrlType::class, $this->getConfiguration("Photo de profil", "URL de votre avatar..."))
            ->add('hash', PasswordType::class, $this->getConfiguration("Mot de passe", "Choisissez un bon mot de passe"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation de votre mot de passe", "Veuillez confirmer votre mot de passe"))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
