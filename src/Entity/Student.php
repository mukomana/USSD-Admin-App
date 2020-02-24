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
    private $age;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $courseWorkScore;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $finalScore;

    

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param mixed $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name): self
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }
    
    /**
     * @param mixed $surname
     */
    public function setSurname($surname): self
    {
        $this->surname = $surname;
    }
    
    /**
     * @return mixed
     */
    public function getAge(): ?int
    {
        return $this->age;
    }
    
    /**
     * @param mixed $age
     */
    public function setAge($age): self
    {
        $this->age = $age;
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
    
    /**
     * @return mixed
     */
    public function getCourseWorkScore(): ?int
    {
        return $this->courseWorkScore;
    }

    /**
     * @param mixed $courseWorkScore
     */
    public function setCourseWorkScore($courseWorkScore): self
    {
        $this->courseWorkScore = $courseWorkScore;
    }

    /**
     * @return mixed
     */
    public function getFinalScore(): ?int
    {
        return $this->finalScore;
    }

    /**
     * @param mixed $finalScore
     */
    public function setFinalScore($finalScore): self
    {
        $this->finalScore = $finalScore;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('user', new NotBlank());
        $metadata->addPropertyConstraint('surname', new NotBlank);
    }
}
?>