<?php

namespace App\Service;

use App\Entity\Media;

final class MediaCollection implements \Countable
{
    private array $medias;

    public function __construct(array $medias = [])
    {
        $this->medias = $medias;
    }

    public function count(): int
    {
        return \count($this->medias);
    }

    public function add(Media $media): self
    {
        $this->medias[] = $media;

        return $this;
    }
}
