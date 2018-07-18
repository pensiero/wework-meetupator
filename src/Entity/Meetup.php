<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Meetup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $sourceId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
