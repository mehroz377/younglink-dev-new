<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SchoolEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SchoolEmployee>
 * @method SchoolEmployee|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolEmployee|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<SchoolEmployee> findAll()
 * @method array<SchoolEmployee> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolEmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolEmployee::class);
    }
}
