<?php

declare(strict_types=1);

namespace App\Model;

final readonly class MesicniStatistika
{
    public function __construct(
        public string $mesic,
        public int $pocetHodnoceni,
        public int $soucetHodnoceni,
    ) {
    }

    public function getPrumerneHodnoceni(): float
    {
        if (0 === $this->pocetHodnoceni) {
            return 0.0;
        }

        return $this->soucetHodnoceni / $this->pocetHodnoceni;
    }
}
