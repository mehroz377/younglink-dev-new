<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('target', ChoiceType::class, [
                'label' => 'Komu chcete zprávu poslat?',
                'choices' => [
//                    TODO - doplnit komu můžeme zprávu poslat? Psycholog, Ředitel, Učitel ?
                    ]
            ])
            ->add('messageText', TextareaType::class, [
                'label' => 'Zpráva',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Odeslat zprávu',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'mapped' => false,
        ]);
    }
}
