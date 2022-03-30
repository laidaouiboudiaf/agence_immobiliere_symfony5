<?php

namespace App\Repository;

use App\Entity\Owners;
use App\Entity\OwnerSearch;
use App\Form\OwnerSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Query;

/**
 * @method Owners|null find($id, $lockMode = null, $lockVersion = null)
 * @method Owners|null findOneBy(array $criteria, array $orderBy = null)
 * @method Owners[]    findAll()
 * @method Owners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Owners::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Owners $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Owners $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllProperties(OwnerSearch $search): Query
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice()) {

            $query
                ->where('o.price < :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());

        }
        if ($search->getMixSurface()) {

            $query
                ->andWhere('o.surface > :minsurface')
                ->setParameter('minsurface', $search->getMixSurface());

        }


        return $query->getQuery();

    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */

    public function totalOwners()
    {
        return $this->createQueryBuilder('o')
            ->select('count(o.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return Owners[]
     */

    public function findLast(): array
    {
        return $this->createQueryBuilder('o')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();


    }

    private function findVisibleQuery(): QueryBuilder
    {

        return $this->createQueryBuilder('o')
            ;


    }


    /*
    public function findOneBySomeField($value): ?Owners
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
