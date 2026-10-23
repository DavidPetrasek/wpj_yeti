<?php

declare(strict_types=1);

namespace App\Twig\Components;

use App\Entity\Yeti;
use App\Form\YetiFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(name: 'pridani_yetiho', template: 'components/pridani_yetiho.html.twig')]
final class PridaniYetihoComponent
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp]
    public bool $uspesneUlozeno = false;

    public function __construct(
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager,
    ) {
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->formFactory->create(YetiFormType::class, new Yeti());
    }

    #[LiveAction]
    public function ulozit(): void
    {
        $this->submitForm();
        $yeti = $this->getForm()->getData();

        $this->entityManager->persist($yeti);
        $this->entityManager->flush();
        $this->uspesneUlozeno = true;
    }
}
