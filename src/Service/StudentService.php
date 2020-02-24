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
    
    public function getStudentByID($id, StudentRepository $studentRepository){
        return $studentRepository->getStudentByID($id);
    }
    
    public function getStudentByMSISDN($msisdn, StudentRepository $studentRepository){
        return $studentRepository->getStudentByMSISDN($msisdn);
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
    public function setStudent($student)
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
    
    /**
     * @param mixed $
     */
    public function getFinalGradesFreq($students)
    {
        
        $gradeA = 0;
        $gradeB = 0;
        $gradeC = 0;
        $gradeD = 0;
        $gradeE = 0;
        $gradeF = 0;
        $gradeFF = 0;
        $ungrade = 0;
        
        foreach ($students as $student){
            $score = $student->getFinalScore();
            switch($score){
                //Code 7 (A Symbol): 80 - 100%
                case $score >= 80 and $score <= 100:
                    $gradeA = $gradeA + 1;
                    break;
                    //Code 6 (B Symbol): 70 - 79%
                case $score >= 70 and $score <=79:
                    $gradeB = $gradeB + 1;
                    break;
                    //Code 5 (C Symbol): 60 - 69%
                case $score >= 60 and $score <= 69:
                    $gradeC = $gradeC + 1;
                    break;
                    //Code 4 (D Symbol): 50 - 59%
                case $score >= 50 and $score <= 59:
                    $gradeD = $gradeD + 1;
                    break;
                    //Code 3 (E Symbol): 40 - 49%
                case $score >= 40 and $score <= 49:
                    $gradeE = $gradeE + 1;
                    break;
                    //Code 2 (F Symbol): 30 - 39%
                case $score >= 30 and $score <= 39:
                    $gradeF = $gradeF + 1;
                    break;
                    //Code 1 (FF Symbol): 0 - 29%
                case $score >= 0 and $score <= 29:
                    $gradeFF = $gradeFF + 1;
                    break;
                    //score cannot be graded
                default:
                    $ungrade = $ungrade + 1;
            }
        };
        
        $gradeFreq = [['Grade', 'Number of Scores'],
        ['A', $gradeA],
        ['B', $gradeB],
        ['C', $gradeC],
        ['D', $gradeD],
        ['E', $gradeE],
        ['F', $gradeF],
        ['FF', $gradeFF],
        ['Ungraded', $ungrade]
        ];
        return $gradeFreq;
    }
    
    /**
     * @param mixed $
     */
    public function getCWGradesFreq($students)
    {
        
        $gradeA = 0;
        $gradeB = 0;
        $gradeC = 0;
        $gradeD = 0;
        $gradeE = 0;
        $gradeF = 0;
        $gradeFF = 0;
        $ungrade = 0;
        
        foreach ($students as $student){
            $score = $student->getFinalScore();
            switch($score){
                //Code 7 (A Symbol): 80 - 100%
                case $score >= 80 and $score <= 100:
                    $gradeA = $gradeA + 1;
                    break;
                    //Code 6 (B Symbol): 70 - 79%
                case $score >= 70 and $score <=79:
                    $gradeB = $gradeB + 1;
                    break;
                    //Code 5 (C Symbol): 60 - 69%
                case $score >= 60 and $score <= 69:
                    $gradeC = $gradeC + 1;
                    break;
                    //Code 4 (D Symbol): 50 - 59%
                case $score >= 50 and $score <= 59:
                    $gradeD = $gradeD + 1;
                    break;
                    //Code 3 (E Symbol): 40 - 49%
                case $score >= 40 and $score <= 49:
                    $gradeE = $gradeE + 1;
                    break;
                    //Code 2 (F Symbol): 30 - 39%
                case $score >= 30 and $score <= 39:
                    $gradeF = $gradeF + 1;
                    break;
                    //Code 1 (FF Symbol): 0 - 29%
                case $score >= 0 and $score <= 29:
                    $gradeFF = $gradeFF + 1;
                    break;
                    //score cannot be graded
                default:
                    $ungrade = $ungrade + 1;
            }
        };
        
        $gradeFreq = [['Grade', 'Number of Scores'],
            ['A', $gradeA],
            ['B', $gradeB],
            ['C', $gradeC],
            ['D', $gradeD],
            ['E', $gradeE],
            ['F', $gradeF],
            ['FF', $gradeFF],
            ['Ungraded', $ungrade]
        ];
        return $gradeFreq;
    }
    
    /**
     * @param mixed $
     */
    public function getCWFinalGradesFreq($students)
    {
        
        $finalGradeA = 0;
        $finalGradeB = 0;
        $finalGradeC = 0;
        $finalGradeD = 0;
        $finalGradeE = 0;
        $finalGradeF = 0;
        $finalGradeFF = 0;
        $finalUngrade = 0;
        
        foreach ($students as $student){
            $score = $student->getFinalScore();
            switch($score){
                //Code 7 (A Symbol): 80 - 100%
                case $score >= 80 and $score <= 100:
                    $finalGradeA = $finalGradeA + 1;
                    break;
                    //Code 6 (B Symbol): 70 - 79%
                case $score >= 70 and $score <=79:
                    $finalGradeB = $finalGradeB + 1;
                    break;
                    //Code 5 (C Symbol): 60 - 69%
                case $score >= 60 and $score <= 69:
                    $finalGradeC = $finalGradeC + 1;
                    break;
                    //Code 4 (D Symbol): 50 - 59%
                case $score >= 50 and $score <= 59:
                    $finalGradeD = $finalGradeD + 1;
                    break;
                    //Code 3 (E Symbol): 40 - 49%
                case $score >= 40 and $score <= 49:
                    $finalGradeE = $finalGradeE + 1;
                    break;
                    //Code 2 (F Symbol): 30 - 39%
                case $score >= 30 and $score <= 39:
                    $finalGradeF = $finalGradeF + 1;
                    break;
                    //Code 1 (FF Symbol): 0 - 29%
                case $score >= 0 and $score <= 29:
                    $finalGradeFF = $finalGradeFF + 1;
                    break;
                    //score cannot be graded
                default:
                    $finalUngrade = $finalUngrade + 1;
            }
        };
        
        $cWGradeA = 0;
        $cWGradeB = 0;
        $cWGradeC = 0;
        $cWGradeD = 0;
        $cWGradeE = 0;
        $cWGradeF = 0;
        $cWGradeFF = 0;
        $cWUngrade = 0;
        
        foreach ($students as $student){
            $score = $student->getCourseWorkScore();
            switch($score){
                //Code 7 (A Symbol): 80 - 100%
                case $score >= 80 and $score <= 100:
                    $cWGradeA = $cWGradeA + 1;
                    break;
                    //Code 6 (B Symbol): 70 - 79%
                case $score >= 70 and $score <=79:
                    $cWGradeB = $cWGradeB + 1;
                    break;
                    //Code 5 (C Symbol): 60 - 69%
                case $score >= 60 and $score <= 69:
                    $cWGradeC = $cWGradeC + 1;
                    break;
                    //Code 4 (D Symbol): 50 - 59%
                case $score >= 50 and $score <= 59:
                    $cWGradeD = $cWGradeD + 1;
                    break;
                    //Code 3 (E Symbol): 40 - 49%
                case $score >= 40 and $score <= 49:
                    $cWGradeE = $cWGradeE + 1;
                    break;
                    //Code 2 (F Symbol): 30 - 39%
                case $score >= 30 and $score <= 39:
                    $cWGradeF = $cWGradeF + 1;
                    break;
                    //Code 1 (FF Symbol): 0 - 29%
                case $score >= 0 and $score <= 29:
                    $cWGradeFF = $cWGradeFF + 1;
                    break;
                    //score cannot be graded
                default:
                    $cWUngrade = $cWUngrade + 1;
            }
        };
        
        $gradeFreq = [['Grade', 'Course Work', 'Final'],
            ['A', $cWGradeA, $finalGradeA],
            ['B', $cWGradeB, $finalGradeB],
            ['C', $cWGradeC, $finalGradeC],
            ['D', $cWGradeD, $finalGradeD],
            ['E', $cWGradeE, $finalGradeE],
            ['F', $cWGradeF, $finalGradeF],
            ['FF', $cWGradeFF, $finalGradeFF],
            ['Ungraded', $cWUngrade, $finalUngrade]
        ];
        return $gradeFreq;
    }
}
?>
