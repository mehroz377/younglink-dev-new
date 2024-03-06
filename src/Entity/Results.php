<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: "created_at", type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToOne(targetEntity: Questionnaire::class)]
    private Questionnaire $questionnaire;

    #[ORM\OneToMany(mappedBy: 'results', targetEntity: StudentResults::class, orphanRemoval: true)]
    private Collection $studentResults;

    #[ORM\OneToOne(mappedBy: "results", targetEntity: Sociograms::class, orphanRemoval: true)]
    private Sociograms $sociograms;

    #[ORM\Column(name: "raw_json", type: "json", nullable: false)]
    private string $rawJson;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $aggression;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $bullyCorePeriphery1;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $bullyCorePeriphery2;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $bullyingReciprocation;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $victimDefending;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $classroomBullies;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $classroomBullyVictims;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $classroomDefenders;

    #[ORM\Column(type: "smallint", nullable: true)]
    private ?int $classroomVictims;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $healthyRelationshipsIndex;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $trustworthinessScore;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $lower80CI;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $upper80CI;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $cohesion;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $corePeriphery1;

    #[ORM\Column(type: "decimal", precision: 5, scale: 4, nullable: true)]
    private ?float $overallReciprocity;

    #[ORM\Column(type: "integer", nullable: false)]
    private int $totalStudents = 0;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->studentResults = new ArrayCollection();
    }

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
     * @return string
     */
    public function getRawJson(): string
    {
        return $this->rawJson;
    }

    /**
     * @param string $rawJson
     */
    public function setRawJson(string $rawJson): void
    {
        $this->rawJson = $rawJson;
    }

    /**
     * @return float|null
     */
    public function getAggression(): ?float
    {
        return $this->aggression;
    }

    /**
     * @param float|null $aggression
     */
    public function setAggression(?float $aggression): void
    {
        $this->aggression = $aggression;
    }

    /**
     * @return float|null
     */
    public function getBullyCorePeriphery1(): ?float
    {
        return $this->bullyCorePeriphery1;
    }

    /**
     * @param float|null $bullyCorePeriphery1
     */
    public function setBullyCorePeriphery1(?float $bullyCorePeriphery1): void
    {
        $this->bullyCorePeriphery1 = $bullyCorePeriphery1;
    }

    /**
     * @return float|null
     */
    public function getBullyCorePeriphery2(): ?float
    {
        return $this->bullyCorePeriphery2;
    }

    /**
     * @param float|null $bullyCorePeriphery2
     */
    public function setBullyCorePeriphery2(?float $bullyCorePeriphery2): void
    {
        $this->bullyCorePeriphery2 = $bullyCorePeriphery2;
    }

    /**
     * @return float|null
     */
    public function getBullyingReciprocation(): ?float
    {
        return $this->bullyingReciprocation;
    }

    /**
     * @param float|null $bullyingReciprocation
     */
    public function setBullyingReciprocation(?float $bullyingReciprocation): void
    {
        $this->bullyingReciprocation = $bullyingReciprocation;
    }

    /**
     * @return float|null
     */
    public function getVictimDefending(): ?float
    {
        return $this->victimDefending;
    }

    /**
     * @param float|null $victimDefending
     */
    public function setVictimDefending(?float $victimDefending): void
    {
        $this->victimDefending = $victimDefending;
    }

    /**
     * @return int|null
     */
    public function getClassroomBullies(): ?int
    {
        return $this->classroomBullies;
    }

    /**
     * @param int|null $classroomBullies
     */
    public function setClassroomBullies(?int $classroomBullies): void
    {
        $this->classroomBullies = $classroomBullies;
    }

    /**
     * @return int|null
     */
    public function getClassroomBullyVictims(): ?int
    {
        return $this->classroomBullyVictims;
    }

    /**
     * @param int|null $classroomBullyVictims
     */
    public function setClassroomBullyVictims(?int $classroomBullyVictims): void
    {
        $this->classroomBullyVictims = $classroomBullyVictims;
    }

    /**
     * @return int|null
     */
    public function getClassroomDefenders(): ?int
    {
        return $this->classroomDefenders;
    }

    /**
     * @param int|null $classroomDefenders
     */
    public function setClassroomDefenders(?int $classroomDefenders): void
    {
        $this->classroomDefenders = $classroomDefenders;
    }

    /**
     * @return int|null
     */
    public function getClassroomVictims(): ?int
    {
        return $this->classroomVictims;
    }

    /**
     * @param int|null $classroomVictims
     */
    public function setClassroomVictims(?int $classroomVictims): void
    {
        $this->classroomVictims = $classroomVictims;
    }

    /**
     * @return float|null
     */
    public function getHealthyRelationshipsIndex(): ?float
    {
        return $this->healthyRelationshipsIndex;
    }

    /**
     * @param float|null $healthyRelationshipsIndex
     */
    public function setHealthyRelationshipsIndex(?float $healthyRelationshipsIndex): void
    {
        $this->healthyRelationshipsIndex = $healthyRelationshipsIndex;
    }

    /**
     * @return float|null
     */
    public function getTrustworthinessScore(): ?float
    {
        return $this->trustworthinessScore;
    }

    /**
     * @param float|null $trustworthinessScore
     */
    public function setTrustworthinessScore(?float $trustworthinessScore): void
    {
        $this->trustworthinessScore = $trustworthinessScore;
    }

    /**
     * @return float|null
     */
    public function getLower80CI(): ?float
    {
        return $this->lower80CI;
    }

    /**
     * @param float|null $lower80CI
     */
    public function setLower80CI(?float $lower80CI): void
    {
        $this->lower80CI = $lower80CI;
    }

    /**
     * @return float|null
     */
    public function getUpper80CI(): ?float
    {
        return $this->upper80CI;
    }

    /**
     * @param float|null $upper80CI
     */
    public function setUpper80CI(?float $upper80CI): void
    {
        $this->upper80CI = $upper80CI;
    }

    /**
     * @return float|null
     */
    public function getCohesion(): ?float
    {
        return $this->cohesion;
    }

    /**
     * @param float|null $cohesion
     */
    public function setCohesion(?float $cohesion): void
    {
        $this->cohesion = $cohesion;
    }

    /**
     * @return float|null
     */
    public function getCorePeriphery1(): ?float
    {
        return $this->corePeriphery1;
    }

    /**
     * @param float|null $corePeriphery1
     */
    public function setCorePeriphery1(?float $corePeriphery1): void
    {
        $this->corePeriphery1 = $corePeriphery1;
    }

    /**
     * @return float|null
     */
    public function getOverallReciprocity(): ?float
    {
        return $this->overallReciprocity;
    }

    /**
     * @param float|null $overallReciprocity
     */
    public function setOverallReciprocity(?float $overallReciprocity): void
    {
        $this->overallReciprocity = $overallReciprocity;
    }

    /**
     * @return Questionnaire
     */
    public function getQuestionnaire(): Questionnaire
    {
        return $this->questionnaire;
    }

    /**
     * @param Questionnaire $questionnaire
     */
    public function setQuestionnaire(Questionnaire $questionnaire): void
    {
        $this->questionnaire = $questionnaire;
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
            $studentResults->setResults($this);
            $this->getStudentResults()->add($studentResults);
        }
    }

    public function removeStudentResults(StudentResults $studentResults): void
    {
        $this->getStudentResults()->removeElement($studentResults);
    }

    /**
     * @return int
     */
    public function getTotalStudents(): int
    {
        return $this->totalStudents;
    }

    /**
     * @param int $totalStudents
     */
    public function setTotalStudents(int $totalStudents): void
    {
        $this->totalStudents = $totalStudents;
    }

    /**
     * @return Sociograms
     */
    public function getSociograms(): Sociograms
    {
        return $this->sociograms;
    }

    /**
     * @param Sociograms $sociograms
     */
    public function setSociograms(Sociograms $sociograms): void
    {
        $this->sociograms = $sociograms;
    }
}
