<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SchoolYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SchoolYear>
 * @method SchoolYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<SchoolYear> findAll()
 * @method array<SchoolYear> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolYear::class);
    }
}
