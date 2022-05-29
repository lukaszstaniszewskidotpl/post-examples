<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 36)]
    private string $uuid;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    public function __construct(string $uuid, string $title)
    {
        $this->uuid = $uuid;
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
