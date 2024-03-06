<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StudentResultsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StudentResultsRepository::class)]
class StudentResults
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: "created_at", type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: Results::class)]
    #[ORM\JoinColumn(name: "results_id", referencedColumnName: "id", nullable: false)]
    private Results $results;

    #[ORM\ManyToOne(targetEntity: Student::class)]
    #[ORM\JoinColumn(name: "student_id", referencedColumnName: "id", nullable: false)]
    private Student $student;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $degree;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $betweenness;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $group1;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $group2;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $group3;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $group4;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $nrGroupsClassroomNotnormalized;

    #[ORM\Column(type: "decimal", precision: 4, scale: 2, nullable: true)]
    private ?float $nrGroupsClassroom;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $influence;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $leadership;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $groupIdentification;

    #[ORM\Column(type: "decimal", precision: 4, scale: 2, nullable: true)]
    private ?float $internalization;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $closenessFriendships;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $victimizationIndegree;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $bullyingOutdegree;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $defendingIndegree;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $defendingOutdegree;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $resilience;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return float|null
     */
    public function getDegree(): ?float
    {
        return $this->degree;
    }

    /**
     * @param float|null $degree
     */
    public function setDegree(?float $degree): void
    {
        $this->degree = $degree;
    }

    /**
     * @return float|null
     */
    public function getBetweenness(): ?float
    {
        return $this->betweenness;
    }

    /**
     * @param float|null $betweenness
     */
    public function setBetweenness(?float $betweenness): void
    {
        $this->betweenness = $betweenness;
    }

    /**
     * @return int|null
     */
    public function getGroup1(): ?int
    {
        return $this->group1;
    }

    /**
     * @param int|null $group1
     */
    public function setGroup1(?int $group1): void
    {
        $this->group1 = $group1;
    }

    /**
     * @return int|null
     */
    public function getGroup2(): ?int
    {
        return $this->group2;
    }

    /**
     * @param int|null $group2
     */
    public function setGroup2(?int $group2): void
    {
        $this->group2 = $group2;
    }

    /**
     * @return int|null
     */
    public function getGroup3(): ?int
    {
        return $this->group3;
    }

    /**
     * @param int|null $group3
     */
    public function setGroup3(?int $group3): void
    {
        $this->group3 = $group3;
    }

    /**
     * @return int|null
     */
    public function getGroup4(): ?int
    {
        return $this->group4;
    }

    /**
     * @param int|null $group4
     */
    public function setGroup4(?int $group4): void
    {
        $this->group4 = $group4;
    }

    /**
     * @return int|null
     */
    public function getNrGroupsClassroomNotnormalized(): ?int
    {
        return $this->nrGroupsClassroomNotnormalized;
    }

    /**
     * @param int|null $nrGroupsClassroomNotnormalized
     */
    public function setNrGroupsClassroomNotnormalized(?int $nrGroupsClassroomNotnormalized): void
    {
        $this->nrGroupsClassroomNotnormalized = $nrGroupsClassroomNotnormalized;
    }

    /**
     * @return float|null
     */
    public function getNrGroupsClassroom(): ?float
    {
        return $this->nrGroupsClassroom;
    }

    /**
     * @param float|null $nrGroupsClassroom
     */
    public function setNrGroupsClassroom(?float $nrGroupsClassroom): void
    {
        $this->nrGroupsClassroom = $nrGroupsClassroom;
    }

    /**
     * @return float|null
     */
    public function getInfluence(): ?float
    {
        return $this->influence;
    }

    /**
     * @param float|null $influence
     */
    public function setInfluence(?float $influence): void
    {
        $this->influence = $influence;
    }

    /**
     * @return int|null
     */
    public function getLeadership(): ?int
    {
        return $this->leadership;
    }

    /**
     * @param int|null $leadership
     */
    public function setLeadership(?int $leadership): void
    {
        $this->leadership = $leadership;
    }

    /**
     * @return int|null
     */
    public function getGroupIdentification(): ?int
    {
        return $this->groupIdentification;
    }

    /**
     * @param int|null $groupIdentification
     */
    public function setGroupIdentification(?int $groupIdentification): void
    {
        $this->groupIdentification = $groupIdentification;
    }

    /**
     * @return float|null
     */
    public function getInternalization(): ?float
    {
        return $this->internalization;
    }

    /**
     * @param float|null $internalization
     */
    public function setInternalization(?float $internalization): void
    {
        $this->internalization = $internalization;
    }

    /**
     * @return float|null
     */
    public function getClosenessFriendships(): ?float
    {
        return $this->closenessFriendships;
    }

    /**
     * @param float|null $closenessFriendships
     */
    public function setClosenessFriendships(?float $closenessFriendships): void
    {
        $this->closenessFriendships = $closenessFriendships;
    }

    /**
     * @return float|null
     */
    public function getVictimizationIndegree(): ?float
    {
        return $this->victimizationIndegree;
    }

    /**
     * @param float|null $victimizationIndegree
     */
    public function setVictimizationIndegree(?float $victimizationIndegree): void
    {
        $this->victimizationIndegree = $victimizationIndegree;
    }

    /**
     * @return float|null
     */
    public function getBullyingOutdegree(): ?float
    {
        return $this->bullyingOutdegree;
    }

    /**
     * @param float|null $bullyingOutdegree
     */
    public function setBullyingOutdegree(?float $bullyingOutdegree): void
    {
        $this->bullyingOutdegree = $bullyingOutdegree;
    }

    /**
     * @return float|null
     */
    public function getDefendingIndegree(): ?float
    {
        return $this->defendingIndegree;
    }

    /**
     * @param float|null $defendingIndegree
     */
    public function setDefendingIndegree(?float $defendingIndegree): void
    {
        $this->defendingIndegree = $defendingIndegree;
    }

    /**
     * @return float|null
     */
    public function getDefendingOutdegree(): ?float
    {
        return $this->defendingOutdegree;
    }

    /**
     * @param float|null $defendingOutdegree
     */
    public function setDefendingOutdegree(?float $defendingOutdegree): void
    {
        $this->defendingOutdegree = $defendingOutdegree;
    }

    /**
     * @return float|null
     */
    public function getResilience(): ?float
    {
        return $this->resilience;
    }

    /**
     * @param float|null $resilience
     */
    public function setResilience(?float $resilience): void
    {
        $this->resilience = $resilience;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * @return Results
     */
    public function getResults(): Results
    {
        return $this->results;
    }

    /**
     * @param Results $results
     */
    public function setResults(Results $results): void
    {
        $this->results = $results;
    }
}
