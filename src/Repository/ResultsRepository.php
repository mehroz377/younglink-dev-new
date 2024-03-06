<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Results;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Results>
 * @method Results|null find($id, $lockMode = null, $lockVersion = null)
 * @method Results|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Results> findAll()
 * @method array<Results> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Results::class);
    }
}
