<?php

namespace App\Controller;
ini_set('memory_limit', '2048M');
use App\Entity\Student;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\StudentType;
use App\Form\Type\UserType;
use Khill\Lavacharts\DataTables\DataTable;
use Khill\Lavacharts\Lavacharts;
use App\Service\StudentService;
use App\Repository\StudentRepository;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;


/**
 * @author Freedom Mukomana
 *
 */
final class StudentController extends AbstractController
{
    /**
     * @var StudentService
     */
    private $studentService;
    
    /**
     * @var StudentRepository
     */
    private $studentRepository;
    
    private $em;
    
    /* public function __construct(UserService $userService){
       $this->userService = $userService; 
    } */
    
    public function index()
    {
      $this->new(Request());
    }
    
    /**
     * @Route("/newstudent", name="newstudent")
     */
    public function new(Request $request) {
        $scoreTable = $this->createTable($student);
        $scoreBarChart = $this->createBarChart($scoreTable);
        
        $form = $this->createFormBuilder($student)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();
        
            return $this->render('user/new.html.twig', [
                'form' => $form->createView(),
                ]
            );
        
        $form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('student/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    //Displays a record of an exist student using MSISDN
    
    /**
     * @Route("/viewstudent/{msisdn}", name="viewstudent")
     */
    public function viewStudentByMSISDN($msisdn, StudentService $studentService, StudentRepository $studentRepository){
        $student = $studentService->getStudentByMSISDN($msisdn, $studentRepository);
        
        $form = $this->createFormBuilder($student)
            ->add('id', NumberType::class)
            ->add('msisdn', TextType::class)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('score', NumberType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();
        
        $form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('student/view_student.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }
    
    //Displays a record of an exist student using MSISDN
    
    /**
     * @Route("/viewstudent/{id}", name="viewstudent")
     */
    public function viewStudentByID(Request $request, $id, StudentService $studentService, StudentRepository $studentRepository){
        
        //Get a record from the database using record id.
        $student = $studentService->getStudentByID($id, $studentRepository);
        
        //Builds a form using form builder.
        $form = $this->createFormBuilder($student)
        ->add('id', NumberType::class)
        ->add('msisdn', TextType::class)
        ->add('name', TextType::class)
        ->add('surname', TextType::class)
        ->add('age', NumberType::class)
        ->add('courseWorkScore', NumberType::class)
        ->add('finalScore', NumberType::class)
        ->add('save', SubmitType::class, ['label' => 'Create Task'])
        ->setData($student)
        ->getForm();
        
        //$form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('student/view_student.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }
    
    //Displays a student table
    
    /**
     * @Route("/student_table", name="student_table")
     */
    public function userList(){
        $user = $this->getUser();
        $students = $this->getDoctrine()->getRepository(Student::class)
            ->findAll();
        
        return $this->render('student/student-list.html.twig', ['students' => $students,
            'user' => $this->getUser(),
        ]);
        
    }
    
    //Generate and displays a barchart using Lavachart (Option 1) - Never worked
    
    /**
     * @Route("/students_chartx", name="student_chart")
     */
    public function studentColumnChart(){
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $manager = $this->getDoctrine()->getConnection();
        
        $studentScoreTable = $this->createTable($students);
        
        $barChart = $this->createBarChart($studentScoreTable);
        
        $lava = new Lavacharts();
        
        return $this->render('student/student-chart.html.twig', ['studentscorechart' => $barChart,
            'user' => $this->getUser(),
        ]);
        
    }
    
    //Generate and displays a barchart using Lavachart (Option 2) - Never worked
    
    /**
     * @Route("/students_barchart", name="students_barchart")
     */
    public function studentBarChart(){
        $lava = new Lavacharts;
        //$lava = $this->get('lavacharts');
        
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $studentScoreTable = $this->createTable($students);
        
        $barChart = $this->createBarChart($studentScoreTable);
        
        $lava = new Lavacharts();
        
        return $this->render('student/student-barchart.html.twig', ['studentscorechart' => $barChart,
            'user' => $this->getUser(),
        ]);
        
    }
    
    //Creates a BarChart using Lavacharts and returns a Barchart instance
    
    public function createBarChart(DataTable $scoreTable) {
        $lava = new Lavacharts();
        $barChart = $lava->LineChart('Scores', $scoreTable, ['title' => 'Frequence Scores']);
        
        return $barChart;
    }
    
    //Creates a BarChart using HighChart - Never worked
    
    /**
     * @Route("/students_chart", name="students_barchart")
     */
    public function barChart(StudentRepository $studentRepository){
        $results = $studentRepository->getScoreFreq();
        
        $ob = $this->createHighchart($results);
        
        return $this->render('student/student-chart.html.twig', ['studentscorechart' => $ob, 
            'user' => $this->getUser(),
        ]);
    }
    
    public function createHighchart($series){
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Score Frequency');
        $ob->chart->type('bar');
        $ob->xAxis->title(array('text'  => "Number of scores"));
        $ob->yAxis->title(array('text'  => "Freq"));
        $ob->series(array(array('data'=>$series)));
        return $ob;
    }
   
    //Retrieves and displays user information from the database
    
    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function show($id)
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
                );
        }
        
        $form = $this->createForm(UserType::class, $user);
        
        return $this->render('user/new.html.twig', ['form' => $form->createView(), 
            'user' => $this->getUser(),
        ]);
    }
}

