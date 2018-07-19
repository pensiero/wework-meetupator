<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Venue
{
    // base url used for url generation
    const BASE_URL = 'https://www.wework.com';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $sourceId;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Meetup", inversedBy="venue", cascade={"persist", "remove"})
     * @var Meetup
     */
    private $meetup;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastEventCrawledAt;

    public function __construct()
    {
        $this->lastEventCrawledAt = new \DateTime();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function echoUrl()
    {
        return self::BASE_URL . $this->getUrl();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    public function setSourceId(string $sourceId): self
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

    public function getMeetup(): ?Meetup
    {
        return $this->meetup;
    }

    public function setMeetup(?Meetup $meetup): self
    {
        $this->meetup = $meetup;

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

    public function getLastEventCrawledAt(): ?\DateTimeInterface
    {
        return $this->lastEventCrawledAt;
    }

    public function setLastEventCrawledAt(\DateTimeInterface $lastEventCrawledAt): self
    {
        $this->lastEventCrawledAt = $lastEventCrawledAt;

        return $this;
    }
}
