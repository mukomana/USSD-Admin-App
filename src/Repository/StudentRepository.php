<?php
namespace App\Repository;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Schema\Table;

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
    
    public function getStudentByMSISDN($msisdn, StudentRepository $studentRepository){
        $entityManager = $this->getEntityManager();
        //$student = $studentRepository->getStudentByMSISDN($userRepository, $msisdn);
        $studentRepository->findBy($criteria);
        $query = $entityManager->createQuery(
            'SELECT * FROM student WHERE student.msisdn = :msisdn')->setParameter('msisdn', $msisdn);
        $query->execute();
        return $query->getArrayResult();
        
    }
    
    public function getScoreFreq(){
        $sql = "SELECT FLOOR(score/10) grade, COUNT(*) count FROM student GROUP BY 1";
        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $scoreFreqArray = array();
        array_push($scoreFreqArray, array('Grade', 'Count'));
        $query->execute();
        foreach ($query as $row) {
             array_push($scoreFreqArray, array($row['grade']*10, $row['count']));
        }
        return $scoreFreqArray;
    }
    
    public function findAll() : array {
        $entityManager = $this->getEntityManager();
        
        $query = $entityManager->createQuery(
            'SELECT student
            FROM App\Entity\Student student'
            );
        $query->execute();
            
            // returns an array of Product objects
            return $query->getResult();
    }
    
    public function getStudentByID($id) {
        $entityManager = $this->getEntityManager();
        
        $student = $entityManager->find('App\Entity\Student', $id);
        
        /* $query = $entityManager->createQuery(
            'SELECT student
            FROM App\Entity\Student student
            WHERE student.id = :id'
            )->setParameter('id', $id);
        
         $query->execute();
        // returns an array of Student objects */
        return $student;
    }
}

