<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Student;
use App\Entity\StudentResults;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentResults>
 * @method StudentResults|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentResults|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<StudentResults> findAll()
 * @method array<StudentResults> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentResultsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentResults::class);
    }
}
