<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Yeti;
use App\Model\YetiPrehled;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Yeti>
 */
class YetiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yeti::class);
    }

    /**
     * @return list<YetiPrehled>
     */
    public function najdiNejlepsi(int $limit = 10): array
    {
        $rows = $this->createQueryBuilder('y')
            ->leftJoin('y.hodnoceni', 'h')
            ->select('y, COALESCE(AVG(h.hodnota), 0) AS prumer, COUNT(h.id) AS pocet')
            ->groupBy('y.id')
            ->orderBy('prumer', 'DESC')
            ->addOrderBy('pocet', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()->getResult();

        return array_map(
            static fn (array $row): YetiPrehled => new YetiPrehled
            (
                $row[0],
                (float) $row['prumer'],
                (int) $row['pocet'],
            ),
            $rows,
        );
    }
}
