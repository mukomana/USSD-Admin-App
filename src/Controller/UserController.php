<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Form\Type\UserType;
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserController extends AbstractController
{
    
    /**
     * @var UserService
     */
    private $userService;
    
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    private $em;
    
    /**
     * @Route("/register_user", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            
            return $this->redirectToRoute('replace_with_some_route');
        }
        
        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
            //'users' => $users,
            'user' => $this->getUser(),
            ]);
    }
    
    /**
     * @Route("/manage_users", name="listUsers")
     */
    public function userList(){
        $user = $this->getUser();
        $users = $this->getDoctrine()->getRepository(User::class)
        ->findAll();
        
        return $this->render('user/user-list.html.twig', ['users' => $users,
            'user' => $this->getUser(),
            'users' => $users, 'user' => $this->getUser(),
        ]);
        
    } 
    
    /**
     * @Route("/viewuser/{id}", name="viewuser")
     */
    public function viewUserByID(Request $request, $id, UserService $userService, UserRepository $userRepository){
        
        //Get a record from the database using record id.
        $user = $userService->getUserByID($id, $userRepository);
        
        //Builds a form using form builder.
        $form = $this->createFormBuilder($user)
        ->add('id', NumberType::class)
        ->add('username', TextType::class)
        ->add('email', TextType::class)
        ->add('isActive', CheckboxType::class)
        ->setData($user)
        ->getForm();
        
        //$form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('user/view_user.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/deleteuser/{id}", name="deleteuser")
     */
    public function deleteUserByID(Request $request, $id, UserService $userService, UserRepository $userRepository){
        
        //Get a record from the database using record id.
        $user = $userService->getUserByID($id, $userRepository);
        
        //Builds a form using form builder.
        $form = $this->createFormBuilder($user)
        ->add('id', NumberType::class)
        ->add('username', TextType::class)
        ->add('email', TextType::class)
        ->add('isActive', CheckboxType::class)
        ->add('delete', SubmitType::class, ['label' => 'Delete User'])
        ->setData($user)
        ->getForm();
        
        //$form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('user/view_user.html.twig', [
            'form' => $form->createView(),
            'users' => $users, 'user' => $this->getUser(),
        ]);
    }
    
    /**
     * @Route("/delete_user", name="delete_user")
     */
    public function deleteUser(Request $request, UserService $userService, UserRepository $userRepository){
        
        //Get a record from the database using record id.
        $user = $userService->getUserByID($id, $userRepository);
        
        //Builds a form using form builder.
        $form = $this->createFormBuilder($user)
        ->add('id', NumberType::class)
        ->add('username', TextType::class)
        ->add('firstname', TextType::class)
        ->add('surname', TextType::class)
        ->add('email', TextType::class)
        ->add('isActive', CheckboxType::class)
        ->add('delete', SubmitType::class, ['label' => 'Delete User'])
        ->setData($user)
        ->getForm();
        
        //$form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            return $this->redirectToRoute('task_success');
        }
        
        return $this->render('user/delete_user.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }
}
