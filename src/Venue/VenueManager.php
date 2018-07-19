<?php

namespace App\Venue;

use App\Entity\Meetup;
use App\Entity\Venue;
use Doctrine\ORM\EntityManagerInterface;

class VenueManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Create a new Venue
     *
     * @param string $sourceId
     * @param string $name
     * @param string $url
     * @param Meetup $meetup
     *
     * @return Venue
     */
    public function createVenue($sourceId, $name, $url, Meetup $meetup): Venue
    {
        $venue = new Venue();
        $venue->setSourceId($sourceId);
        $venue->setName($name);
        $venue->setUrl($url);
        $venue->setMeetup($meetup);

        $this->em->persist($venue);
        $this->em->flush();

        return $venue;
    }
}