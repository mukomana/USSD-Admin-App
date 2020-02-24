<?php
namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Freedom Mukomana
 *
 */
class UserService
{
    /* Member variables */
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /* public function __construct(UserRepository $userRepository)
    {
       $this->userRepository = $userRepository;
    }    */
    
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->userRepository->getUser();
    }
    
    public function getUserBySessionID(){
        return null;   
    }
    
    public function getUserByID($id, UserRepository $userRepository){
        return $userRepository->getUserByID($id);
    }
    
    public function getUserByUsername($username, UserRepository $userRepository){
        return $userRepository->getUserByUsername($username);
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        return $this->userRepository->saveUser($user);
    }

    /**
     * @param mixed $allUsers
     */
    public function setAllUsers($allUsers)
    {
        $this->allUsers = $allUsers;
    }
}
?>
