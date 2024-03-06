<?php

declare(strict_types=1);

namespace App\Entity\ProfessionalHelp;

use App\Repository\ProfessionalHelp\ProfessionalHelpArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ProfessionalHelpArticleRepository::class)]
class ProfessionalHelpArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column]
    private string $title;
    #[ORM\Column]
    private string $slug;
    #[ORM\Column]
    private string $image = '';
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $date;
    #[ORM\Column(type: 'text')]
    private string $text;

    private ?UploadedFile $uploadedImage = null;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return \DateTime
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTimeImmutable $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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
        return $this->getTitle();
    }
}
