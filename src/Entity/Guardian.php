<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GuardianRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GuardianRepository::class)]
class Guardian
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $firstname;

    #[ORM\Column(length: 255)]
    private string $lastname;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\ManyToMany(targetEntity: Student::class, mappedBy: 'guardians', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'student_guardians')]
    private Collection $students;

    #[ORM\OneToOne(inversedBy: 'guardian', targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user = null;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
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

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        if (!$this->getStudents()->contains($student)){
            $this->getStudents()->add($student);
        }
    }

    public function removeStudent(Student $student): void
    {
        $student->removeGuardian($this);
        if ($this->getStudents()->contains($student)){
            $this->getStudents()->removeElement($student);
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

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
