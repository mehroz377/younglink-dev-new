<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints\Time;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
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
    private string $name;

    #[ORM\ManyToMany(targetEntity: SchoolEmployee::class, mappedBy: 'classrooms')]
    #[ORM\JoinTable(
        name: 'teacher_classroom',
        joinColumns: [new ORM\JoinColumn(name: 'classroom_id', referencedColumnName: 'id', onDelete: "CASCADE")]
    )]
    private Collection $schoolEmployees;

    #[ORM\OneToMany(targetEntity: Timeline::class, mappedBy: 'classroom', orphanRemoval: true)]
    private Collection $timelines;

    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'classroom')]
    private Collection $students;

    public function __construct()
    {
        $this->schoolEmployees = new ArrayCollection();
        $this->timelines = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getSchool(): School
    {
        return $this->school;
    }

    public function setSchool(School $school): void
    {
        $this->school = $school;
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

    public function getSchoolEmployees(): Collection
    {
        return $this->schoolEmployees;
    }

    public function addSchoolEmployee(SchoolEmployee $schoolEmployee): void
    {
        if (!$this->schoolEmployees->contains($schoolEmployee)) {
            $this->schoolEmployees->add($schoolEmployee);
            $schoolEmployee->addClassroom($this);
        }
    }

    public function removeSchoolEmployee(SchoolEmployee $schoolEmployee): void
    {
        $this->schoolEmployees->removeElement($schoolEmployee);
    }

    /**
     * @param Collection $schoolEmployees
     */
    public function setSchoolEmployees(Collection $schoolEmployees): void
    {
        $this->schoolEmployees = $schoolEmployees;
    }

    /**
     * @return Collection
     */
    public function getTimelines(): Collection
    {
        return $this->timelines;
    }

    public function addTimeline(Timeline $timeline): void
    {
        if (!$this->timelines->contains($timeline)) {
            $this->timelines->add($timeline);
            $timeline->setClassroom($this);
        }
    }

    public function removeTimeline(Timeline $timeline): void
    {
        if ($this->timelines->contains($timeline)){
            $this->timelines->removeElement($timeline);
        }
    }

    /**
     * @return Collection
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setClassroom($this);
            $student->setSchool($this->getSchool());
        }
    }

    public function removeStudent(Student $student): void
    {
        if ($this->students->contains($student)){
            $this->students->removeElement($student);
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
