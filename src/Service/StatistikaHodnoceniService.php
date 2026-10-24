<?php declare(strict_types=1);

namespace App\Service;

use App\Model\MesicniStatistika;
use App\Repository\HodnoceniRepository;
use App\Repository\YetiRepository;

final class StatistikaHodnoceniService
{
    public function __construct(
        private HodnoceniRepository $hodnoceniRepository,
        private YetiRepository $yetiRepository,
    ) {
    }

    /**
     * @return list<MesicniStatistika>
     */
    public function mesicniPrehled(int $pocetMesicu = 12): array
    {
        $mesice = [];

        foreach ($this->hodnoceniRepository->findBy([], ['datumHodnoceni' => 'DESC']) as $hodnoceni) 
        {
            $mesic = $hodnoceni->getDatumHodnoceni()->format('Y-m');
            $mesice[$mesic] ??= ['pocet' => 0, 'soucet' => 0];
            ++$mesice[$mesic]['pocet'];
            $mesice[$mesic]['soucet'] += $hodnoceni->getHodnota();
        }

        $prehled = [];

        foreach (array_slice($mesice, 0, $pocetMesicu, true) as $mesic => $udaje) 
        {
            $prehled[] = new MesicniStatistika($mesic, $udaje['pocet'], $udaje['soucet']);
        }

        return $prehled;
    }

    public function pocetYeti(): int
    {
        return $this->yetiRepository->count();
    }

    public function hodnoceniPocet(): int
    {
        return $this->hodnoceniRepository->count();
    }
}
