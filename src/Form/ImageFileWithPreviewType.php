<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ImageFileWithPreviewType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
        'required' => false,
        'data_class' => null,
        'attr' => array(
        'accept' => 'image/jpeg,image/png',
        ),

        'data_attribute' => null,
        ));
    }

    public function getParent(): string
    {
        return FileType::class;
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        if (!isset($options['data_attribute'])) {
            return;
        }

        $view->vars['data_attribute'] = $options['data_attribute'];
    }

    public function getBlockPrefix(): string
    {
        return 'image_file_with_preview';
    }
}
