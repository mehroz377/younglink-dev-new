<?php

declare(strict_types=1);

namespace App\Repository\ProfessionalHelp;

use App\Entity\ProfessionalHelp\ProfessionalHelpExpertLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfessionalHelpExpertLabel>
 * @method ProfessionalHelpExpertLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionalHelpExpertLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<ProfessionalHelpExpertLabel> findAll()
 * @method array<ProfessionalHelpExpertLabel> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionalHelpExpertLabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionalHelpExpertLabel::class);
    }
}
