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
     * @var int
     */
    private $sourceId;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Venue", mappedBy="meetup", cascade={"persist", "remove"})
     * @var Venue
     */
    private $venue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    public function __toString()
    {
        return $this->name;
    }

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

    public function getVenue(): ?Venue
    {
        return $this->venue;
    }

    public function setVenue(?Venue $venue): self
    {
        $this->venue = $venue;

        // set (or unset) the owning side of the relation if necessary
        $newMeetup = $venue === null ? null : $this;
        if ($newMeetup !== $venue->getMeetup()) {
            $venue->setMeetup($newMeetup);
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
