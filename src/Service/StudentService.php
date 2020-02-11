<?php
namespace App\Service;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Freedom Mukomana
 *
 */
class StudentService
{
    /* Member variables */
    /**
     * @var StudentRepository
     */
    private $studentRepository;
    
    /* public function __construct(UserRepository $userRepository)
    {
       $this->userRepository = $userRepository;
    }    */
    
    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->studentRepository->getStudent();
    }
    
    public function getStudentBySessionID(){
        return null;   
    }
    
    public function getStudentByMSISDN($msisdn){
        return $this->userRepository->getStudentByMSISDN($msisdn);
    }

    /**
     * @return mixed
     */
    public function getAllStudents()
    {
        return $this->userRepository->getAllStudents();
    }

    /**
     * @return mixed
     */
    public function getAllStudentScores()
    {
        return $this->allStudentScores;
    }

    /**
     * @param mixed $student
     */
    public function setUser($student)
    {
        return $this->studentRepository->saveStudent($student);
    }

    /**
     * @param mixed $allStudents
     */
    public function setAllStudents($allStudents)
    {
        $this->allStudents = $allStudents;
    }

    /**
     * @param mixed $allStudentScores
     */
    public function setAllStudentScores($allStudentScores)
    {
        $this->allStudentScores = $allStudentScores;
    }
}
?>
