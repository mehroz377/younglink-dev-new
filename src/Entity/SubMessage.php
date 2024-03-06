<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MainMessageRepository;
use App\Repository\SubMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SubMessageRepository::class)]
class SubMessage
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

    #[ORM\ManyToOne(targetEntity: MainMessage::class)]
    #[ORM\JoinColumn(nullable: false)]
    private MainMessage $mainMessage;

    #[ORM\Column(name: "message_text", type: "text", nullable: false)]
    private string $messageText;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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
     * @return MainMessage
     */
    public function getMainMessage(): MainMessage
    {
        return $this->mainMessage;
    }

    /**
     * @param MainMessage $mainMessage
     */
    public function setMainMessage(MainMessage $mainMessage): void
    {
        $this->mainMessage = $mainMessage;
    }

    /**
     * @return string
     */
    public function getMessageText(): string
    {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     */
    public function setMessageText(string $messageText): void
    {
        $this->messageText = $messageText;
    }
}
