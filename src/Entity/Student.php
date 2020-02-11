<?php
//src/Entity/User.php
namespace App\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * 
 */
class Student {
        
    /* Member variables */
    
    /** 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $msisdn;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $surname;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $score;
    
    
    //private $monthlyCosts = array();
    
    
    //private $subject = array();

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(int $id): self
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getMsisdn(): ?string
    {
        return $this->msisdn;
    }
    
    public function setMsisdn(string $msisdn): self
    {
        $this->msisdn = $msisdn;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }
    
    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    
    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
     
    /**
     * @return multitype:
     *
     public function getSubject()
     {
     return $this->subject;
     }*/
    
    /**
     * @param multitype: $subject
     *
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return multitype:
     
    public function getMonthlyCosts()
    {
        return $this->monthlyCosts;
    }

    /**
     * @param multitype: $monthlyCosts
     *
    public function setMonthlyCosts($monthlyCosts)
    {
        $this->monthlyCosts = $monthlyCosts;
    }*/
    
    public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('user', new NotBlank());
        $metadata->addPropertyConstraint('surname', new NotBlank);
    }
}
?>