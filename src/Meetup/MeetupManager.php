<?php

namespace App\Meetup;

use App\Entity\Meetup;
use Doctrine\ORM\EntityManagerInterface;

class MeetupManager
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
     * Create a new Meetup
     *
     * @param string $sourceId
     * @param string $name
     *
     * @return Meetup
     */
    public function createMeetup($sourceId, $name, $url): Meetup
    {
        $meetup = new Meetup();
        $meetup->setSourceId($sourceId);
        $meetup->setName($name);
        $meetup->setUrl($url);

        $this->em->persist($meetup);
        $this->em->flush();

        return $meetup;
    }
}