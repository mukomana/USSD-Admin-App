<?php

namespace App\Controller;
ini_set('memory_limit', '2048M');
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\StudentType;
use Khill\Lavacharts\DataTables\DataTable;
use Khill\Lavacharts\Lavacharts;
use App\Service\StudentService;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Khill\Lavacharts\Charts\HistogramChart;

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
     * @Route("/createstudent", name="createstudent")
     */
    public function createStudent(): Response {
        //$this->userService = new UserService();
        $entityManager = $this->getDoctrine()->getManager();
        
        //Create a user object and initializes some data for this example
        $student = new Student();
        $student->setMsisdn(27732941795);
        $student->setName('Freedom');
        $student->setSurname('Mukomana');
        $student->setScore(20);
        //$user->setMonthlyCosts(array('300.00,200.00,400.00'));
        //$message = $this->userService->setUser($user);
        $entityManager->persist($student);
        $entityManager->flush();
        
        echo 'Student '.$student->getName().' saved';
        
        return $this->render('user/new.html.twig', ['student' => $student]);
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
                //'table' => $scoreTable,
                //'barchart' => $scoreBarChart
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
    
    /**
     * @Route("/viewstudent/{msisdn}", name="viewstudent")
     */
    public function viewStudent($msisdn){
        //$entityManager = $this->getDoctrine()->getManager();
        //$this->repo = $this->getDoctrine()->getRepository(User::class);
        //$repository = $entityManager->getRepository(User::class);
        $msisdn = '27732941795';
        $student = $this->studentService->getUserByMSISDN($msisdn);
        $form = $this->createFormBuilder($user)
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
        
        echo 'rendering form';
        
        return $this->render('student/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    public function createTable($students) {
       $lava = new Lavacharts();
       
       $scoresTable =  $lava->DataTable();
       
       $scoresTable->addStringColumn('Name')
                   ->addStringColumn('Surname')
                   ->addNumberColumn('Score');
       
       $scoresTable->addRows([
           ['Freedom', 300],
           ['Mukomana', 200],
           ['Mitch', 400]
       ]);
       
       foreach ($students as $student){
           $scoresTable->addRow([$student->getName(), $student->getScore()]);
       }
       
       return $scoresTable;
    }
    
    /**
     * @Route("/student_table", name="student_table")
     */
    public function userList(){
        $students = $this->getDoctrine()->getRepository(Student::class)
            ->findAll();
        
        return $this->render('student/student-list.html.twig', ['students' => $students]);
        
    }
    
    /**
     * @Route("/students_chart", name="student_chart")
     */
    public function studentColumnChart(){
        $students = $this->getDoctrine()->getRepository(Student::class)
        ->findAll();
        
        $studentScoreTable = $this->createTable($students);
        
        $barChart = $this->createBarChart($studentScoreTable);
        
        $lava = new Lavacharts();
        
        return $this->render('student/student-chart.html.twig', array('studentscorechart' => $barChart, ));
        
    }
    
    public function createBarChart(DataTable $scoreTable) {
        $lava = new Lavacharts();
        $barChart = $lava->BarChart('Scores', $scoreTable, 'div_barchart');
        
        return $barChart;
    }
    
    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function show($id)
    {
        $user = $this->getDoctrine()
        ->getRepository(Student::class)
        ->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
                );
        }
        
        /* $form = $this->createFormBuilder($user)
        ->add('id', NumberType::class)
        ->add('msisdn', TextType::class)
        ->add('name', TextType::class)
        ->add('surname', TextType::class)
        ->add('score', NumberType::class)
        ->add('save', SubmitType::class, ['label' => 'Create Task'])
        ->getForm(); */
        
        $form = $this->createForm(StudentType::class, $student);
        
        /* $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            
            return $this->redirectToRoute('task_success');
        } */
        
        //echo 'rendering form';
        
        return $this->render('student/new.html.twig', [
            'form' => $form->createView(),
        ]);
        
        //return new Response('Check out this great product: '.$user->getName());
        
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}

