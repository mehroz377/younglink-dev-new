<?php

declare(strict_types=1);

namespace App\Repository\ProfessionalHelp;

use App\Entity\ProfessionalHelp\ProfessionalHelpArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfessionalHelpArticle>
 * @method ProfessionalHelpArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionalHelpArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<ProfessionalHelpArticle> findAll()
 * @method array<ProfessionalHelpArticle> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionalHelpArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionalHelpArticle::class);
    }
}
