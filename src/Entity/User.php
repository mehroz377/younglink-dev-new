<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends BaseUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected $id;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Guardian::class)]
    private Guardian|null $guardian = null;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: SchoolEmployee::class)]
    private SchoolEmployee|null $schoolEmployee = null;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Student::class)]
    private Student|null $student = null;

    /**
     * @return Guardian|null
     */
    public function getGuardian(): ?Guardian
    {
        return $this->guardian;
    }

    /**
     * @param Guardian|null $guardian
     */
    public function setGuardian(?Guardian $guardian): void
    {
        $this->guardian = $guardian;
    }

    /**
     * @return SchoolEmployee|null
     */
    public function getSchoolEmployee(): ?SchoolEmployee
    {
        return $this->schoolEmployee;
    }

    /**
     * @param SchoolEmployee|null $schoolEmployee
     */
    public function setSchoolEmployee(?SchoolEmployee $schoolEmployee): void
    {
        $this->schoolEmployee = $schoolEmployee;
    }

    /**
     * @return Student|null
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student|null $student
     */
    public function setStudent(?Student $student): void
    {
        $this->student = $student;
    }
}
