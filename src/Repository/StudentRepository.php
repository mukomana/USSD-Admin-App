<?php
namespace App\Repository;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class StudentRepository extends ServiceEntityRepository
{
    /**
     * @var EntityRepository
     */
    private $repository;
    
    private $repo;
    
    private $em;

    /* public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(User::class);
    } */
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }
        
    public function saveStudent($student){
        $this->em->persist($student);
        echo 'Student '.$student->name.'saved';
        return new Response('Student '.$student->name.'saved');
    }
    
    public function getAllStudents(){
        return $this->repository->findAll();
    }
    
    public function getUserByMSISDN($msisdn){
        
        //$user = $userRepository->getUserByMSISDN($userRepository, $msisdn);
        
        return $this->repository->findOneBy([
            'msisdn' => $msisdn]
        );
    }
    
    public function getScores(){
        
    }
    
    public function findAll() : array {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            'SELECT student
            FROM App\Entity\Student student'
            );
            
            // returns an array of Product objects
            return $query->getResult();
    }
    
    public function findUserByID($id) {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            'SELECT student
            FROM App\Entity\Student student
            WHERE student.id = :id)'
            )->setParameter('id', $id);
        
        // returns an array of Product objects
        return $query->getResult();
    }
}

