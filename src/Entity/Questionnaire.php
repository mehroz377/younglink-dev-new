<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    public const FULL_QUESTIONNAIRE = 'full_questionnaire';
    public const CONTROL_QUESTIONNAIRE = 'control_questionnaire';
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: 'name', type: 'string', nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Timeline::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Timeline $timeline;

    #[ORM\Column(type: "smallint")]
    private int $position;

    #[ORM\Column]
    private bool $finished = false;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $type = self::CONTROL_QUESTIONNAIRE;

    #[ORM\Column(type: 'datetime_immutable', nullable: false)]
    private \DateTimeImmutable $fillDate;

    #[ORM\ManyToMany(targetEntity: Student::class, mappedBy: 'questionnaires')]
    #[ORM\JoinTable(
        name: 'student_questionnaire',
        joinColumns: [new ORM\JoinColumn(name: 'questionnaire_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    )]
    private Collection $students;

    #[ORM\OneToOne(mappedBy: "questionnaire", targetEntity: Results::class, cascade: ["PERSIST"], orphanRemoval: true)]
    private ?Results $results = null;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTimeline(): Timeline
    {
        return $this->timeline;
    }

    public function setTimeline(Timeline $timeline): void
    {
        $this->timeline = $timeline;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): void
    {
        $this->finished = $finished;
    }

    public function finish(): static
    {
        $this->finished = true;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFillDate(): \DateTimeImmutable
    {
        return $this->fillDate;
    }

    /**
     * @param \DateTimeImmutable $fillDate
     */
    public function setFillDate(\DateTimeImmutable $fillDate): void
    {
        $this->fillDate = $fillDate;
    }

    /**
     * @return Collection
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    /**
     * @param Collection $students
     */
    public function setStudents(Collection $students): void
    {
        $this->students = $students;
    }

    public function addStudent(Student $student): void
    {
        if (!$this->getStudents()->contains($student)){
            $this->getStudents()->add($student);
            $student->addQuestionnaire($this);
        }
    }

    public function removeStudent(Student $student): void
    {
        $this->getStudents()->removeElement($student);
        $student->removeQuestionnaire($this);
    }

    /**
     * @return Results|null
     */
    public function getResults(): ?Results
    {
        return $this->results;
    }

    /**
     * @param Results|null $results
     */
    public function setResults(?Results $results): void
    {
        $this->results = $results;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
