<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Gender;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private School $school;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Classroom $classroom;

    #[ORM\Column(length: 255)]
    # Should be unique across classroom, but not across the whole application
    private string $egoId;

    #[ORM\Column(length: 255)]
    private Gender $gender;

    #[ORM\Column(length: 255)]
    private string $firstname;

    #[ORM\Column(length: 255)]
    private string $lastname;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\ManyToMany(targetEntity: Guardian::class, inversedBy: 'students',orphanRemoval: true)]
    #[ORM\JoinTable(name: 'student_guardians')]
    private Collection $guardians;

    #[ORM\OneToOne(inversedBy: 'student', targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user = null;

    #[ORM\ManyToMany(targetEntity: Questionnaire::class, inversedBy: 'students')]
    #[ORM\JoinTable(
        name: 'student_questionnaire',
        joinColumns: [new ORM\JoinColumn(name: 'student_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    )]
    private Collection $questionnaires;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: StudentResults::class,orphanRemoval: true)]
    private Collection $studentResults;

    public function __construct()
    {
        $this->guardians = new ArrayCollection();
        $this->questionnaires = new ArrayCollection();
        $this->studentResults = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getSchool(): School
    {
        return $this->school;
    }

    public function setSchool(School $school): static
    {
        $this->school = $school;

        return $this;
    }

    public function getClassroom(): Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(Classroom $classroom): static
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getEgoId(): string
    {
        return $this->egoId;
    }

    public function setEgoId(string $egoId): void
    {
        $this->egoId = $egoId;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getGuardians(): Collection
    {
        return $this->guardians;
    }

    public function addGuardian(Guardian $guardian): void
    {
        if (!$this->getGuardians()->contains($guardian)){
            $this->getGuardians()->add($guardian);
        }
        $guardian->addStudent($this);
    }

    public function removeGuardian(Guardian $guardian): void
    {
        if ($this->getGuardians()->contains($guardian)){
            $this->getGuardians()->removeElement($guardian);
        }
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function getQuestionnaires(): Collection
    {
        return $this->questionnaires;
    }

    public function addQuestionnaire(Questionnaire $questionnaire): void
    {
        if (!$this->getQuestionnaires()->contains($questionnaire)){
            $this->getQuestionnaires()->add($questionnaire);
            $questionnaire->addStudent($this);
        }
    }

    public function removeQuestionnaire(Questionnaire $questionnaire): void
    {
        $this->getQuestionnaires()->removeElement($questionnaire);
    }

    /**
     * @return Collection
     */
    public function getStudentResults(): Collection
    {
        return $this->studentResults;
    }

    /**
     * @param Collection $studentResults
     */
    public function setStudentResults(Collection $studentResults): void
    {
        $this->studentResults = $studentResults;
    }

    public function addStudentResults(StudentResults $studentResults): void
    {
        if (!$this->getStudentResults()->contains($studentResults)){
            $studentResults->setStudent($this);
            $this->getStudentResults()->add($studentResults);
        }
    }

    public function removeStudentResults(StudentResults $studentResults): void
    {
        $this->getStudentResults()->removeElement($studentResults);
    }

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
