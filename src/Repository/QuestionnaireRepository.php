<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Questionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Questionnaire>
 * @method Questionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Questionnaire> findAll()
 * @method array<Questionnaire> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionnaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questionnaire::class);
    }
}
