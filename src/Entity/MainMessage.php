<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MainMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MainMessageRepository::class)]
class MainMessage
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: "created_at", type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "from_id", referencedColumnName: "id")]
    private User $from;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "to_id", referencedColumnName: "id")]
    private User $to;

    #[ORM\OneToMany(mappedBy: 'mainMessage', targetEntity: SubMessage::class, orphanRemoval: true)]
    private Collection $messages;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->messages = new ArrayCollection();
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
     * @return User
     */
    public function getFrom(): User
    {
        return $this->from;
    }

    /**
     * @param User $from
     */
    public function setFrom(User $from): void
    {
        $this->from = $from;
    }

    /**
     * @return User
     */
    public function getTo(): User
    {
        return $this->to;
    }

    /**
     * @param User $to
     */
    public function setTo(User $to): void
    {
        $this->to = $to;
    }

    /**
     * @return Collection
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(SubMessage $subMessage): void
    {
        if (!$this->getMessages()->contains($subMessage)){
            $this->messages->add($subMessage);
            $subMessage->setMainMessage($this);
        }
    }

    public function removeMessage(SubMessage $subMessage): void
    {
        $this->messages->removeElement($subMessage);
    }
}
