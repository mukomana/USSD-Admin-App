<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
        ->where('u.username = :username OR u.email = :email')
        ->setParameter('username', $username)
        ->setParameter('email', $email)
        ->getQuery()
        ->getOneOrNullResult();
    }
    
    public function saveUser($user){
        $this->em->persist($user);
        echo 'Student '.$user->name.'saved';
        return new Response('User '.$user->name.'saved');
    }
    
    public function getAllStudents(){
        return $this->repository->findAll();
    }
    
    public function getUserByUsername($username){
        
        //$user = $userRepository->getUserByMSISDN($userRepository, $msisdn);
        
        return $this->repository->findOneBy([
            'username' => $username]
            );
    }
    
    public function findAll() : array {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            'SELECT user
            FROM App\Entity\User user'
            );
        
        // returns an array of user objects
        return $query->getResult();
    }
    
    public function getUserByID($id) {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            'SELECT user
            FROM App\Entity\User user
            WHERE user.id = :id'
            )->setParameter('id', $id);
            
            // returns an User objects
            return $query->getResult();
    }
}
