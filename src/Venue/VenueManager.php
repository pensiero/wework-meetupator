<?php

namespace App\Venue;

use App\Entity\Meetup;
use App\Entity\Venue;
use App\Meetup\MeetupManager;
use Doctrine\ORM\EntityManagerInterface;

class VenueManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var MeetupManager
     */
    protected $meetupManager;

    /**
     * @param EntityManagerInterface $em
     * @param MeetupManager          $meetupManager
     */
    public function __construct(EntityManagerInterface $em, MeetupManager $meetupManager)
    {
        $this->em = $em;
        $this->meetupManager = $meetupManager;
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

    /**
     * Crawl a Venue
     *
     * @param Venue $venue
     */
    public function crawlVenue(Venue $venue)
    {
        $data = [
            'time'        => (new \DateTime('2018-07-19 16:00:00'))->getTimestamp(),
            'duration'    => 3600000,
            'name'        => 'Happy Hour: Beer Tasting With BRLO',
            'description' => 'Please join us for our Happy Hour where we will be treated to a tasting session with BRLO craft beer with a range of IPAs and Lager. See you there and feel free to bring your friends! And Vote for your Favourite and will put it on tap for a month.',
            'latitude'    => 52.506378,
            'longitude'   => 13.3732382,
        ];

        $this->meetupManager->addMeetupEvent($venue->getMeetup(), $data);
    }
}