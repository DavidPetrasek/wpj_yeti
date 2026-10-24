<?php declare(strict_types=1);

namespace App\Model;

use App\Entity\Yeti;

final readonly class YetiPrehled
{
    public function __construct(
        public Yeti $yeti,
        public float $hodnoceniPrumer,
        public int $hodnoceniPocet,
    ) 
    {}
}
