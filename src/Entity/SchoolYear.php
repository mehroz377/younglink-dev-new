<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SchoolYearRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SchoolYearRepository::class)]
class SchoolYear
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: 'year', type: 'string', nullable: false)]
    private string $year;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function __toString(): string
    {
        return $this->getYear();
    }
}
