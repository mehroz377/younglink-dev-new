<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SubMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubMessage>
 * @method SubMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<SubMessage> findAll()
 * @method array<SubMessage> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubMessage::class);
    }
}
