<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StudentResultsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StudentResultsRepository::class)]
class Sociograms
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(name: "created_at", type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToOne(inversedBy: "sociograms", targetEntity: Results::class)]
    #[ORM\JoinColumn(name: "results_id", referencedColumnName: "id", nullable: false)]
    private Results $results;

    #[ORM\Column(name: "friendship_network_unweighted", type: "text")]
    private string $friendshipNetworkUnweighted;

    #[ORM\Column(name: "friendship_network_weighted", type: "text")]
    private string $friendshipNetworkWeighted;

    #[ORM\Column(name: "bully_network_unweighted", type: "text")]
    private string $bullyNetworkUnweighted;

    #[ORM\Column(name: "bully_network_weighted", type: "text")]
    private string $bullyNetworkWeighted;

    #[ORM\Column(name: "defending_network_unweighted", type: "text")]
    private string $defendingNetworkUnweighted;

    #[ORM\Column(name: "defending_network_weighted", type: "text")]
    private string $defendingNetworkWeighted;

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
     * @return string
     */
    public function getFriendshipNetworkUnweighted(): string
    {
        return $this->friendshipNetworkUnweighted;
    }

    /**
     * @param string $friendshipNetworkUnweighted
     */
    public function setFriendshipNetworkUnweighted(string $friendshipNetworkUnweighted): void
    {
        $this->friendshipNetworkUnweighted = $friendshipNetworkUnweighted;
    }

    /**
     * @return string
     */
    public function getFriendshipNetworkWeighted(): string
    {
        return $this->friendshipNetworkWeighted;
    }

    /**
     * @param string $friendshipNetworkWeighted
     */
    public function setFriendshipNetworkWeighted(string $friendshipNetworkWeighted): void
    {
        $this->friendshipNetworkWeighted = $friendshipNetworkWeighted;
    }

    /**
     * @return string
     */
    public function getBullyNetworkUnweighted(): string
    {
        return $this->bullyNetworkUnweighted;
    }

    /**
     * @param string $bullyNetworkUnweighted
     */
    public function setBullyNetworkUnweighted(string $bullyNetworkUnweighted): void
    {
        $this->bullyNetworkUnweighted = $bullyNetworkUnweighted;
    }

    /**
     * @return string
     */
    public function getBullyNetworkWeighted(): string
    {
        return $this->bullyNetworkWeighted;
    }

    /**
     * @param string $bullyNetworkWeighted
     */
    public function setBullyNetworkWeighted(string $bullyNetworkWeighted): void
    {
        $this->bullyNetworkWeighted = $bullyNetworkWeighted;
    }

    /**
     * @return string
     */
    public function getDefendingNetworkUnweighted(): string
    {
        return $this->defendingNetworkUnweighted;
    }

    /**
     * @param string $defendingNetworkUnweighted
     */
    public function setDefendingNetworkUnweighted(string $defendingNetworkUnweighted): void
    {
        $this->defendingNetworkUnweighted = $defendingNetworkUnweighted;
    }

    /**
     * @return string
     */
    public function getDefendingNetworkWeighted(): string
    {
        return $this->defendingNetworkWeighted;
    }

    /**
     * @param string $defendingNetworkWeighted
     */
    public function setDefendingNetworkWeighted(string $defendingNetworkWeighted): void
    {
        $this->defendingNetworkWeighted = $defendingNetworkWeighted;
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
