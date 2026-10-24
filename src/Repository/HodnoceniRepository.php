<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Hodnoceni;
use App\Model\MesicniStatistika;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hodnoceni>
 */
class HodnoceniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hodnoceni::class);
    }

    /**
     * @return list<MesicniStatistika>
     */
    public function najdiMesicniStatistiky(int $pocetMesicu): array
    {
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder()
            ->select(
                "DATE_FORMAT(datum_hodnoceni, '%Y-%m') AS mesic",
                'COUNT(id) AS hodnoceni_pocet',
                'SUM(hodnota) AS hodnoceni_soucet',
            )
            ->from('hodnoceni')
            ->groupBy('mesic')
            ->orderBy('mesic', 'DESC')
            ->setMaxResults($pocetMesicu);

        $rows = $queryBuilder->fetchAllAssociative();

        $statistiky = array_map(
            static fn (array $row): MesicniStatistika => new MesicniStatistika(
                $row['mesic'],
                (int) $row['hodnoceni_pocet'],
                (int) $row['hodnoceni_soucet'],
            ),
            $rows,
        );

        return $statistiky;
    }
}
