<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TimelineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TimelineRepository::class)]
class Timeline
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: SchoolYear::class)]
    #[ORM\JoinColumn(nullable: false)]
    private SchoolYear $schoolYear;

    #[ORM\ManyToOne(targetEntity: Classroom::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Classroom $classroom;

    #[ORM\Column]
    private bool $active = false;

    #[ORM\OneToMany(mappedBy: 'timeline', targetEntity: Questionnaire::class, orphanRemoval: true)]
    private Collection $questionnaires;

    public function __construct()
    {
        $this->questionnaires = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getSchoolYear(): SchoolYear
    {
        return $this->schoolYear;
    }

    public function setSchoolYear(SchoolYear $schoolYear): void
    {
        $this->schoolYear = $schoolYear;
    }

    public function getClassroom(): Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(Classroom $classroom): void
    {
        $this->classroom = $classroom;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function activate(): static
    {
        $this->active = true;

        return $this;
    }

    public function deactivate(): static
    {
        $this->active = false;

        return $this;
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
        if (!$this->questionnaires->contains($questionnaire)) {
            $this->questionnaires->add($questionnaire);
            $questionnaire->setTimeline($this);
        }
    }

    public function removeQuestionnaire(Questionnaire $questionnaire): void
    {
        if ($this->questionnaires->contains($questionnaire)){
            $this->questionnaires->removeElement($questionnaire);
        }
    }

    public function __toString(): string
    {
        return $this->schoolYear . ' - ' . $this->classroom;
    }
}
