<?php declare(strict_types=1);

namespace App\Form;

use App\Model\Pohlavi;
use App\Entity\Yeti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class YetiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jmeno', TextType::class, [
                'label' => 'Jméno Yetiho',
                'attr' => ['placeholder' => 'Například Sněžný Hubert'],
                'empty_data' => '',
                'constraints' => [
                    new Assert\NotBlank(message: 'Vyplňte jméno Yetiho.'),
                    new Assert\Length(max: 120),
                ],
            ])
            ->add('pohlavi', EnumType::class, [
                'class' => Pohlavi::class,
                'label' => 'Pohlaví',
                'choice_label' => static fn (?Pohlavi $pohlavi): string => $pohlavi?->getLabel() ?? '',
                'placeholder' => 'Vyberte pohlaví',
                'constraints' => [
                    new Assert\NotBlank(message: 'Vyberte pohlaví.'),
                ],
            ])
            ->add('vyska', IntegerType::class, [
                'label' => 'Výška (cm)',
                'attr' => ['min' => 1, 'placeholder' => '230'],
                'empty_data' => 0,
                'constraints' => [
                    new Assert\NotBlank(message: 'Vyplňte výšku.'),
                    new Assert\Positive(message: 'Výška musí být kladné číslo.'),
                ],
            ])
            ->add('vaha', IntegerType::class, [
                'label' => 'Váha (kg)',
                'attr' => ['min' => 1, 'placeholder' => '180'],
                'empty_data' => 0,
                'constraints' => [
                    new Assert\NotBlank(message: 'Vyplňte váhu.'),
                    new Assert\Positive(message: 'Váha musí být kladné číslo.'),
                ],
            ])
            ->add('bydliste', TextType::class, [
                'label' => 'Kde bydlí',
                'attr' => ['placeholder' => 'Například Krkonoše'],
                'empty_data' => '',
                'constraints' => [
                    new Assert\NotBlank(message: 'Vyplňte bydliště.'),
                    new Assert\Length(max: 120),
                ],
            ])
            ->add('popis', TextareaType::class, [
                'label' => 'Něco o něm',
                'required' => false,
                'attr' => ['rows' => 4, 'placeholder' => 'Zájmy, povaha nebo oblíbené místo...'],
                'constraints' => [
                    new Assert\Length(max: 500),
                ],
            ])
            ->add('ulozit', SubmitType::class, [
                'label' => 'Přidat Yetiho',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Yeti::class,
        ]);
    }
}
