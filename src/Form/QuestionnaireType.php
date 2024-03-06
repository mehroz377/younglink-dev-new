<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Název šetření',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Jaké chcete šetření zahájit',
                'choices' => [
                    'Velké obecné šetření' => Questionnaire::FULL_QUESTIONNAIRE,
                    'Kontrolní šetření' => Questionnaire::CONTROL_QUESTIONNAIRE,
                ],
                'required' => true,
            ])
            ->add('fillDate', DateTimeType::class, [
                'label' => 'Za kdy má být vyplněno',
                'required' => true,
            ])
            ->add('students', ChoiceType::class, [
                'label' => 'Vyberte žáky',
                'choices' => [], // TODO doplnit žáky ze seznamu třídy
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Naplánovat šetření',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
