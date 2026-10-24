<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Hodnoceni;
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
}
