<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $user = $this->getUser();
        return $this->render('student/index.html.twig', [
            'user' => $user,
        ]);
    }
    
}