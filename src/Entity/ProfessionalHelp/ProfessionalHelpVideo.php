<?php

declare(strict_types=1);

namespace App\Entity\ProfessionalHelp;

use App\Repository\ProfessionalHelp\ProfessionalHelpVideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ProfessionalHelpVideoRepository::class)]
class ProfessionalHelpVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column]
    private string $title;

    #[ORM\Column]
    private string $image = '';

    #[ORM\Column]
    private string $url;

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
        return $this->title;
    }
}
