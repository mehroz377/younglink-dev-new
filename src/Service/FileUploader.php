<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class FileUploader
{
    /** @var array<string> */
    private array $settings;

    /**
     * @param array<string> $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function saveFile(UploadedFile $file): ?string
    {
        $now = new \DateTime();

        $directory = "/{$now->format('Y')}/{$now->format('m')}/{$now->format('d')}/" .
            substr(md5(random_bytes(10)), 0, 10);
        $fileName = $file->getClientOriginalName();

        $file->move($this->settings['target_path'] . $directory, $fileName);

        return "{$this->settings['web_path']}{$directory}/{$fileName}";
    }

    public function getFileSize(string $path): false|int
    {
        return (new File($path))->getSize();
    }
}
