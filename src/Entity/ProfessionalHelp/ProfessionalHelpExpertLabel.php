<?php

declare(strict_types=1);

namespace App\Entity\ProfessionalHelp;

use App\Repository\ProfessionalHelp\ProfessionalHelpExpertLabelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionalHelpExpertLabelRepository::class)]
class ProfessionalHelpExpertLabel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column]
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
       return $this->name;
    }
}
