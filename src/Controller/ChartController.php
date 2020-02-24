<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use App\Entity\Student;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ScatterChart;
use App\Service\StudentService;


class ChartController extends AbstractController
{
    
    /**
     * @var StudentRepository
     */
    private $studentRepository;
    
    /**
     * @var StudentService
     */
    private $studentService;
    
    /**
     * @Route("/piechart", name="piechart")
     */
    public function pieChart(StudentRepository $studentRepository, StudentService $studentService)
    {
        $pieChart = new PieChart();
        
        //$scoreFreqs = $this->studentRepository->getScoreFreq();
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $gradeFreq = $studentService->getGradesFreq($students);
        
        
        $pieChart->getData()->setArrayToDataTable($gradeFreq);
        
        $pieChart->getOptions()->setTitle('Score Grades');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->getLegend()->setAlignment('center');
        $pieChart->getOptions()->setIs3D(true);
        
        return $this->render('student/student-piechart.html.twig', ['piechart' => $pieChart,
            'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/barchart", name="barchart")
     */
    public function barChart(StudentRepository $studentRepository, StudentService $studentService)
    {
        $barChart = new BarChart();
        
        //$scoreFreqs = $this->studentRepository->getScoreFreq();
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $gradeFreq = $studentService->getGradesFreq($students);
        
        $barChart->getData()->setArrayToDataTable(
            $gradeFreq
            );
        
        $barChart->getOptions()->setTitle('Score Grades');
        $barChart->getOptions()->setHeight(500);
        $barChart->getOptions()->setWidth(700);
        $barChart->getOptions()->getTitleTextStyle()->setBold(true);
        $barChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $barChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $barChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $barChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $barChart->getOptions()->getLegend()->setAlignment('center');
        $barChart->getOptions()->getVAxis()->setTitle('Grade');
        $barChart->getOptions()->getHAxis()->setTitle('Number of Scores');
        
        return $this->render('student/student-barchart.html.twig', ['barchart' => $barChart,
            'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/histogram", name="histogram")
     */
    public function histogram(StudentRepository $studentRepository, StudentService $studentService)
    {
        $histogram = new Histogram();
        
        //$scoreFreqs = $this->studentRepository->getScoreFreq();
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        //$gradeFreq = $studentService->getCWGradesFreq($students);
        $studentFinalScores = [['Student', 'Final Score']];
        foreach($students as $student){
            array_push($studentFinalScores, [$student->getName(), $student->getFinalScore()]);
        }
        
        $histogram->getData()->setArrayToDataTable(
            $studentFinalScores
            );
        
        $histogram->getOptions()->setTitle('Score Frequency');
        $histogram->getOptions()->setHeight(500);
        $histogram->getOptions()->setWidth(700);
        $histogram->getOptions()->getTitleTextStyle()->setBold(true);
        $histogram->getOptions()->getTitleTextStyle()->setColor('#009900');
        $histogram->getOptions()->getTitleTextStyle()->setItalic(true);
        $histogram->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $histogram->getOptions()->getTitleTextStyle()->setFontSize(20);
        $histogram->getOptions()->setTitlePosition('centre');
        //$histogram->getOptions()->setVAxes('Number of Scores');
        
        return $this->render('student/student-histogram.html.twig', ['histogram' => $histogram,
            'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/columnchart", name="columnchart")
     */
    public function columnChart(StudentRepository $studentRepository, StudentService $studentService)
    {
        $columnChart = new ColumnChart();
        
        //$scoreFreqs = $this->studentRepository->getScoreFreq();
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $gradeFreq = $studentService->getCWFinalGradesFreq($students);
          
        $columnChart->getData()->setArrayToDataTable(
           $gradeFreq
            );
        
        $columnChart->getOptions()->setTitle('Score Grades');
        $columnChart->getOptions()->setHeight(500);
        $columnChart->getOptions()->setWidth(700);
        $columnChart->getOptions()->getTitleTextStyle()->setBold(true);
        $columnChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $columnChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $columnChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $columnChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $columnChart->getOptions()->getHAxis()->setTitle('Grades');
        $columnChart->getOptions()->getVAxis()->setTitle('Number of Scores');
        $columnChart->getOptions()->getLegend()->setAlignment('center');
        
        return $this->render('student/student-columnchart.html.twig', ['columnchart' => $columnChart,
            'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/scatterchart", name="scatterchart")
     */
    public function scatterChart(StudentRepository $studentRepository, StudentService $studentService)
    {
        $scatterChart = new ScatterChart();
        
        //$scoreFreqs = $this->studentRepository->getScoreFreq();
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $scoreArray = array(array('Course Work', 'Final'));
        foreach($students as $student){
            array_push($scoreArray, array($student->getCourseWorkScore(), $student->getFinalScore()));
        }
        $scatterChart->getData()->setArrayToDataTable(
            $scoreArray
            );
        
        $scatterChart->getOptions()->setTitle('Score Grades');
        $scatterChart->getOptions()->setHeight(500);
        $scatterChart->getOptions()->setWidth(700);
        $scatterChart->getOptions()->getTitleTextStyle()->setBold(true);
        $scatterChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $scatterChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $scatterChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $scatterChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        
        return $this->render('student/student-scatterchart.html.twig', ['scatterchart' => $scatterChart,
            'user' => $this->getUser(),
        ]);
    }
}