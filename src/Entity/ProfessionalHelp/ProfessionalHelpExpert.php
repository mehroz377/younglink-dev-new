<?php

declare(strict_types=1);

namespace App\Entity\ProfessionalHelp;

use App\Entity\District;
use App\Repository\ProfessionalHelp\ProfessionalHelpExpertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ProfessionalHelpExpertRepository::class)]
class ProfessionalHelpExpert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column]
    private string $firstname;
    #[ORM\Column]
    private string $lastname;
    #[ORM\Column]
    private string $specialization;
    #[ORM\Column]
    private string $phone;
    #[ORM\Column]
    private string $email;
    #[ORM\Column]
    private string $url;
    #[ORM\Column]
    private string $image = '';
    #[ORM\Column(type: 'text')]
    private string $description;

    private ?UploadedFile $uploadedImage = null;

    #[ORM\ManyToMany(targetEntity: ProfessionalHelpExpertLabel::class)]
    #[ORM\JoinTable(
        name: 'professional_help_expert_labels',
        joinColumns: [new ORM\JoinColumn(name: 'expert_id', referencedColumnName: 'id')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'label_id', referencedColumnName: 'id')]
    )]
    private Collection $labels;

    #[ORM\ManyToOne(targetEntity: District::class)]
    #[ORM\JoinColumn(name: 'district_id', referencedColumnName: 'id', nullable: false)]
    private $district;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
    }

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
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    /**
     * @param string $specialization
     */
    public function setSpecialization(string $specialization): void
    {
        $this->specialization = $specialization;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(ProfessionalHelpExpertLabel $label): self
    {
        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
        }

        return $this;
    }

    public function removeLabel(ProfessionalHelpExpertLabel $label): self
    {
        $this->labels->removeElement($label);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district): void
    {
        $this->district = $district;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedImage(): ?UploadedFile
    {
        return $this->uploadedImage;
    }

    /**
     * @param UploadedFile|null $uploadedImage
     */
    public function setUploadedImage(?UploadedFile $uploadedImage): void
    {
        $this->uploadedImage = $uploadedImage;
    }

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
