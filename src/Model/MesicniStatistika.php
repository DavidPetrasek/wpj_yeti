<?php declare(strict_types=1);

namespace App\Model;

final readonly class MesicniStatistika
{
    public function __construct(
        public string $mesic,
        public int $hodnoceniPocet,
        public int $hodnoceniSoucet,
    ) 
    {}

    public function getHodnoceniPrumer(): float
    {
        if (0 === $this->hodnoceniPocet) return 0.0;

        return $this->hodnoceniSoucet / $this->hodnoceniPocet;
    }

    public function getHodnoceniProcenta(): ?float
    {
        if (0 === $this->hodnoceniPocet) return null;

        return ($this->getHodnoceniPrumer() + 1) * 50;
    }
}
