<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SchoolRepository::class)]
class School
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'school', targetEntity: Classroom::class)]
    private Collection $classrooms;
    #[ORM\OneToMany(mappedBy: 'school', targetEntity: SchoolEmployee::class, orphanRemoval: true)]
    private Collection $schoolEmployees;

    #[ORM\ManyToOne(targetEntity: District::class)]
    #[ORM\JoinColumn(name: 'district_id', referencedColumnName: 'id', nullable: false)]
    private $district;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
        $this->schoolEmployees = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): void
    {
        $classroom->setSchool($this);

        $this->getClassrooms()->add($classroom);
    }

    public function removeClassroom(Classroom $classroom): void
    {
        $this->getClassrooms()->removeElement($classroom);
    }

    /**
     * @param Collection $classrooms
     */
    public function setClassrooms(Collection $classrooms): void
    {
        $this->classrooms = $classrooms;
    }

    /**
     * @return Collection
     */
    public function getSchoolEmployees(): Collection
    {
        return $this->schoolEmployees;
    }

    public function addSchoolEmployee(SchoolEmployee $schoolEmployee): void
    {
        $schoolEmployee->setSchool($this);
        $this->getSchoolEmployees()->add($schoolEmployee);
    }

    public function removeSchoolEmployee(SchoolEmployee $schoolEmployee): void
    {
        $this->getSchoolEmployees()->removeElement($schoolEmployee);
    }

    /**
     * @param Collection $schoolEmployees
     */
    public function setSchoolEmployees(Collection $schoolEmployees): void
    {
        $this->schoolEmployees = $schoolEmployees;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district): void
    {
        $this->district = $district;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
