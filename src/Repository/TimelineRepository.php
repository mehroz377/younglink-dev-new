<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Timeline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Timeline>
 * @method Timeline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timeline|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Timeline> findAll()
 * @method array<Timeline> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimelineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timeline::class);
    }
}
