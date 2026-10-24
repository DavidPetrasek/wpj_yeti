<?php declare(strict_types=1);

namespace App\Twig\Components;

use App\Entity\Yeti;
use App\Form\YetiFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class PridaniYetiho extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp]
    public bool $uspesneUlozeno = false;

    public function __construct
    (
        private EntityManagerInterface $entityManager,
    ) 
    {}

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(YetiFormType::class, new Yeti());
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
