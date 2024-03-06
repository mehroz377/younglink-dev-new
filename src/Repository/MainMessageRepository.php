<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MainMessage;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainMessage>
 * @method MainMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<MainMessage> findAll()
 * @method array<MainMessage> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainMessage::class);
    }

    /** @return array<int,MainMessage> */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('main_message')
            ->where("main_message.from = :user")
            ->orWhere("main_message.to = :user")
            ->setParameter("user",$user)
            ->orderBy("main_message.created_at")
            ->getQuery()->getResult();
    }
}
