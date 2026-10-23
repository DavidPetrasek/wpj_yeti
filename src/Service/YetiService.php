<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Hodnoceni;
use App\Entity\Yeti;
use App\Repository\YetiRepository;
use Doctrine\ORM\EntityManagerInterface;

final class YetiService
{
    public function __construct(
        private YetiRepository $yetiRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function vyberNahodneho(?int $vyloucitId = null): ?Yeti
    {
        $yeti = array_values(array_filter(
            $this->yetiRepository->findAll(),
            static fn (Yeti $yeti): bool => $yeti->getId() !== $vyloucitId,
        ));

        if ([] === $yeti) {
            return null;
        }

        return $yeti[random_int(0, count($yeti) - 1)];
    }

    public function ohodnot(Yeti $yeti, int $hodnota): void
    {
        if (!in_array($hodnota, [-1, 1], true)) {
            throw new \InvalidArgumentException('Hodnocení musí být -1 nebo 1.');
        }

        $this->entityManager->persist(new Hodnoceni($yeti, $hodnota));
        $this->entityManager->flush();
    }
}
