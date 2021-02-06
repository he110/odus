<?php

namespace App\Repository;

use App\Entity\ChatUser;
use App\Reference\ChatUserReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChatUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChatUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChatUser[]    findAll()
 * @method ChatUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatUser::class);
    }

    public function findChatUser(string $uid, int $channelType = ChatUserReference::CHANNEL_TYPE_UNKNOWN): ?ChatUser
    {
        return $this->createQueryBuilder('u')
            ->where('u.uid = :uid')
            ->andWhere('u.channelType = :type')
            ->setParameters([
                'uid' => $uid,
                'type' => $channelType
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return ChatUser[] Returns an array of ChatUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChatUser
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
