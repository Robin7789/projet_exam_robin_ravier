<?php

namespace App\Form;

use App\Entity\Game;
use App\Form\DataTransformer\StringToFileTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GameType extends AbstractType
{
    private $fileTransformer;

    public function __construct(StringToFileTransformer $fileTransformer)
    {
        $this->fileTransformer = $fileTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('image', FileType::class, [
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (PNG or JPEG)',
                    ])
                ],
                'data_class' => null, // Important for handling file uploads
            ])
            ->add('genre', TextType::class)
            ->add('developer', TextType::class)
            ->add('release_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('platform', TextType::class);

        // Add the transformer
        $builder->get('image')->addModelTransformer($this->fileTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
