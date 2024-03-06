<?php

declare(strict_types=1);

namespace App\Repository\ProfessionalHelp;

use App\Entity\ProfessionalHelp\ProfessionalHelpVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfessionalHelpVideo>
 * @method ProfessionalHelpVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionalHelpVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<ProfessionalHelpVideo> findAll()
 * @method array<ProfessionalHelpVideo> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionalHelpVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionalHelpVideo::class);
    }
}
