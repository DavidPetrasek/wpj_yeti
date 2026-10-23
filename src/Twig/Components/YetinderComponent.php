<?php

declare(strict_types=1);

namespace App\Twig\Components;

use App\Entity\Yeti;
use App\Repository\YetiRepository;
use App\Service\YetiService;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent(name: 'yetinder', template: 'components/yetinder.html.twig')]
final class YetinderComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public ?int $yetiId = null;

    private ?Yeti $nactenyYeti = null;

    public function __construct(
        private YetiRepository $yetiRepository,
        private YetiService $yetiService,
    ) {
    }

    #[ExposeInTemplate(name: 'yeti')]
    public function getYeti(): ?Yeti
    {
        if (null === $this->yetiId) {
            return null;
        }

        if (null === $this->nactenyYeti || $this->nactenyYeti->getId() !== $this->yetiId) {
            $this->nactenyYeti = $this->yetiRepository->find($this->yetiId);
        }

        return $this->nactenyYeti;
    }

    #[LiveAction]
    public function ohodnot(#[LiveArg] int $hodnota): void
    {
        $yeti = $this->getYeti();

        if (null === $yeti) {
            return;
        }

        $this->yetiService->ohodnot($yeti, $hodnota);
        $dalsiYeti = $this->yetiService->vyberNahodneho($this->yetiId);
        $this->yetiId = $dalsiYeti?->getId();
        $this->nactenyYeti = $dalsiYeti;
    }
}
