<?php

declare(strict_types=1);

namespace App\Repository\ProfessionalHelp;

use App\Entity\ProfessionalHelp\ProfessionalHelpExpert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfessionalHelpExpert>
 * @method ProfessionalHelpExpert|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionalHelpExpert|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<ProfessionalHelpExpert> findAll()
 * @method array<ProfessionalHelpExpert> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionalHelpExpertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionalHelpExpert::class);
    }
}
