<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $courseMark;

    /**
     * @ORM\Column(type="integer")
     */
    private $examMark;

    /**
     * @ORM\Column(type="integer")
     */
    private $finalMark;
    
    /**
     * @ORM\ManyToOne(targetEntity="Student")
     */
    private $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCourseMark(): ?int
    {
        return $this->courseMark;
    }

    public function setCourseMark(int $courseMark): self
    {
        $this->courseMark = $courseMark;

        return $this;
    }

    public function getExamMark(): ?int
    {
        return $this->examMark;
    }

    public function setExamMark(int $examMark): self
    {
        $this->examMark = $examMark;

        return $this;
    }

    public function getFinalMark(): ?int
    {
        return $this->finalMark;
    }

    public function setFinalMark(int $finalMark): self
    {
        $this->finalMark = $finalMark;

        return $this;
    }
    /**
     * @return \App\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param \App\Entity\Student $student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    
    
}
