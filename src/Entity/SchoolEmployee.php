<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SchoolEmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SchoolEmployeeRepository::class)]
class SchoolEmployee
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: School::class)]
    #[ORM\JoinColumn(nullable: false)]
    private School $school;

    #[ORM\Column(length: 255)]
    private string $firstname;

    #[ORM\Column(length: 255)]
    private string $lastname;

    #[ORM\Column(length: 20)]
    private string $schoolEmployeeRole;

    #[ORM\ManyToMany(targetEntity: Classroom::class, inversedBy: 'schoolEmployees')]
    #[ORM\JoinTable(
        name: 'teacher_classroom',
        joinColumns: [new ORM\JoinColumn(name: 'school_employee_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    )]
    private Collection $classrooms;

    #[ORM\OneToOne(inversedBy: 'schoolEmployee', targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user = null;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
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

    public function getSchoolEmployeeRole(): string
    {
        return $this->schoolEmployeeRole;
    }

    public function setSchoolEmployeeRole(string $schoolEmployeeRole): void
    {
        $this->schoolEmployeeRole = $schoolEmployeeRole;
    }

    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): void
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
            $classroom->addSchoolEmployee($this);
        }
    }

    public function removeClassroom(Classroom $classroom): void
    {
        $this->classrooms->removeElement($classroom);
        $classroom->removeSchoolEmployee($this);
    }

    /**
     * @param Collection $classrooms
     */
    public function setClassrooms(Collection $classrooms): void
    {
        $this->classrooms = $classrooms;
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

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
